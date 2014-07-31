<?php	
// errorCode <00001 - 00099>
include_once(DOCROOT.'/include/basic.class.php');

class auth extends basic {
	var $blockAccountAfterBadLogin; // ma sa konto blokovat
	var $blockAccountBadLoginCount;	// po kolkych zlych pokusoch sa konto zablokuje
	var $blockTime;					// na aku dobu sa zablokuje
	var $logoutTime;				// automaticke odlogovanie po neciinosti
	var $klientIP;					// IP adresa klient
	var $klientHost;				// Host name klienta
	var $klientReques;				// Pozadovana stranka klient
	var $isLoggedSuccessful;		// Ci je klient nalogovany spravne
	var $sql;						// nazov sql konnekcie na DB
	var $authKlientData;			// udaje o klientovi
	var $authKlientPermissions;		// pristupove prava klienta
	
	function auth() {
		$this->blockAccountAfterBadLogin = true;
		$this->blockAccountBadLoginCount = 3;
		$this->blockTime 			= 24*60*60; // 24 hodin
		$this->logoutTime 			= 3*60*60; // 3 hodiny
		
		$this->klientIP 			= $_SERVER['REMOTE_ADDR'];
		$this->klientHost 			= isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : gethostbyaddr($this->klientIP);
		$this->klientReques 		= $_SERVER['REQUEST_URI'];
		$this->isLoggedSuccessful 	= false;
		$this->sql = new sql();
		//$this->sql					= new sql('mr');
		
		if (strip_tags($_GET['logout'])==1){
			$this->logout();
		}else{	
			$this->login();
		}
	}
	
	function logout(){
		unset($_SESSION['klientLogin']);
		unset($_SESSION['klientPasswd']);
		unset($_SESSION['firstLogin']);
		unset($_SESSION['badLoginCount']);
		$this->klientIP 			= null;
		$this->klientHost 			= null;
		$this->klientReques 		= null;
		$this->isLoggedSuccessful 	= false;
		$this->authKlientData 		= array();
		$this->authKlientPermissions= array();
	}
	
	function login(){
		// ak sa cez formular posle login		
		if (isset($_POST['login'])){
			$_SESSION['klientLogin'] = strip_tags($_POST['login']);
			$_SESSION['klientPasswd'] = md5(strip_tags($_POST['passwd']));
			$_SESSION['firstLogin'] = 1;
		} else {
			$_SESSION['firstLogin'] = 0;
		}
			
		
		if(!isset($_SESSION['klientLogin'])){
			// ak nieje v session 
			$this->isLoggedSuccessful = false;
		} else {
			// ak je nastavene v session login
			// zistim udaje z DB
			$sql = "
				SELECT 
					web_login, web_heslo, id, blocked_to, aktivny, nazov, mesto, ulica, psc, ico, kontakt1, tel1
				FROM clients
				WHERE 
					web_login = '".$_SESSION['klientLogin']."' AND 
					aktivny = 'A';
			";		
						

			/* @var $sqlDB sql */ 
			$sqlDB = $this->sql;
			$res = $sqlDB->sql_query($sql);
			//echo $sql."<br>";
											
			if($res===false){
				// nieje mozne overit prihladovacie udaje
				$this->_error('00001');
				$this->logout();
				return false;
			}
			
			$numRows = $sqlDB->sql_num_rows($res);
			if($numRows!=1){
				// neexistujuce konto
				$this->_error('00002');
				$this->logout();
				return false;
			}
					
			$sqlLoginData = $sqlDB->sql_fetch_row($res); // pom
		
			if ($_SESSION['klientLogin'] == $sqlLoginData[0] AND $_SESSION['klientPasswd'] == $sqlLoginData[1]){
				// prihlasovacie udaje su spravne
				
				if (time() < $sqlLoginData[3]){
					// ak je konto zablokovane - vypisem info o tom

					// Your account was blocked! Log in will by possible at .date("d.m.Y - G:i:s",$sqlLoginData[3])
					$this->_error('00003');
					
					$this->logout();
					return false;
				} else {
					
					// ak konto zablokovane nie je
					$_SESSION['badLoginCount']	= 0;

					// prihlasenie OK
					$this->_error('00004');					
					$this->authKlientData['login']	 = $sqlLoginData['web_login'];
					$this->authKlientData['id'] 	 = $sqlLoginData['id'];					
					$this->authKlientData['name']	 = $sqlLoginData['nazov'];					
					$this->authKlientData['city']	 = $sqlLoginData['mesto'];					
					$this->authKlientData['street'] 	 = $sqlLoginData['ulica'];					
					$this->authKlientData['psc'] 	 = $sqlLoginData['psc'];					
					$this->authKlientData['ico'] 	 = $sqlLoginData['ico'];					
					$this->authKlientData['contact'] = $sqlLoginData['kontakt1'];					
					$this->authKlientData['phone']   = $sqlLoginData['tel1'];					
					
					// precitam ostatne nastavenia uzivatela
					$sql = "
						SELECT nazov,mesto,ulica,psc,ico,dic
						FROM clients
						WHERE id = $sqlLoginData[2]	;
					";
					$resProp = $sqlDB->sql_query($sql);
					if($resProp!=false){
						while(($propData=$sqlDB->sql_fetch_row($resProp))!=false){
							$this->authKlientData[$propData[0]]	= $propData[1];
						}
					}

					if($_SESSION['firstLogin'] != 1){
						// zistim pocet sekund od poslednej akcie
						$sql = "
							SELECT EXTRACT (epoch from timestamptz_mi(now(),last_action)) 
							FROM clients
							WHERE id = $sqlLoginData[2];
						";
						$res = $sqlDB->sql_query($sql);
						$lastActionData = $sqlDB->sql_fetch_row($res);
						$lastActionBefore = $lastActionData[0];
						
						if ($this->logoutTime < $lastActionBefore){
							// ak je prekroceny cas. limit na akciu => odhlasenie

							//_("You was logout automatically after ").($logout_time/(60*60))._(" hours of inactivity.");
							$this->_error('00005');

							$this->logout();
							return false;
						}else{
							// zaznamenanie casu akcie, koli automatickemu odhlasovaniu
							$sql ="
								UPDATE clients
								SET last_action = now() 
								WHERE id = $sqlLoginData[2];
							"; 
							$sqlDB->sql_query($sql);
							$this->isLoggedSuccessful = true;
						}
					} else {
						// zaznamenanie casu akcie, koli automatickemu odhlasovaniu
						$sql ="
							UPDATE clients
							SET last_action = now() 
							WHERE id = $sqlLoginData[2];
						"; 
						$sqlDB->sql_query($sql);
						$this->isLoggedSuccessful = true;
					}
				}
			} else {
				// zly login alebo heslo
				$_SESSION['badLoginCount']++;		// inkrementovanie pocitadla zlych prihlaseni
		
				if ($this->blockAccountAfterBadLogin AND $_SESSION['badLoginCount'] > $this->blockAccountBadLoginCount AND $numRows>0){
					// ak je pocet zlych loginv nad ramec a ak je pokus lognut sa ako urcity klient
					$nextPossibleLogin = time() + $this->blockTime;	// vypocet casu pokial bude konto blokovane
			
					$sql = "
						UPDATE clients
						SET blocked_to = '".date("Y-m-d H:i:s",$nextPossibleLogin)."' 
						WHERE id = $sqlLoginData[2];
					";
					$sqlDB->sql_query($sql);

					// _("Your account was blocked after ").$_SESSION['bad_login_count']._(" unsuccessful log in tries! Log in will by possible at").date("d.m.Y - G:i:s",$possible_login).".";
					$this->_error('00006');
					
					$this->logout();
				} else {
					// ak zle udaje na prihlasenie a pocet pokusov nebol prekroceny, 
					// alebo pokus o prihlasenie pod neexistujucim loginom
					// vypisem chybu

					// _("You entered incorrect login or password!");
					$this->_error('00007');

					$this->isLoggedSuccessful = false;
				}
			}
		} // !isset($_SESSION['klientLogin']
	} // function
}
?>
