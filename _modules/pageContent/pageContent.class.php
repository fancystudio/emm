<?php
include_once(DOCROOT.'/include/basic.class.php');
include_once(DOCROOT.'/include/cart.class.php');
include_once('include/captcha/php-captcha.inc.php');
include_once(DOCROOT.'/include/XPM2/smtp.php');


class pageContent extends basic {
	var $templateObject;	/* @var $templateObject template*/ // ukazovatel na objekt sablony
	var $sqlDB;				/* @var $sqlDB sql */	// sql connection object
	var $auth;				/* @var $auth auth */	// authentification object
	var $page;				/* @var $page Page */	// page object
	var $cart;				/* @var $cart cart*/ // objekt nakupneho kosiku
	var $languagePage;
	var $lang_skratka;
	
	function pageContent(){
		$this->sqlDB = new sql();
	}
	
	function getPageData($pageId=null){
		if($pageId===null)
			return false;
			
		if($pageId==1) {
			$pageId=3;
		}

		$sql = "
			SELECT id, title, type, status, date(created) AS created
			FROM page
			WHERE status = 1 AND id = $pageId;
		";
		$res = $this->sqlDB->sql_query($sql);
		
		if($res==false)
			return false;
		if($this->sqlDB->sql_num_rows($res)!=1)
			return false;
		
		$data = $this->sqlDB->sql_fetch_row($res);
		
		$sql = "
			SELECT property_name, property_value
			FROM page_properties
			WHERE id_page = $pageId;
		";
		$res = $this->sqlDB->sql_query($sql);
		if($res==false)
			return false;
		
		while(($propData=$this->sqlDB->sql_fetch_row($res))!=false){
			$data[$propData['property_name']] = $propData['property_value'];
		}
			
		return $data;
	}

	function getSiteMapNode($pageId=0){
		if(!isset($pageId) OR !is_numeric($pageId) OR $pageId===''){
			return false;
		}
		
		$sql = "
			SELECT a.id_sub_page, a.link_text, count(b.id_sub_page) AS sub_count
			FROM page_connection AS a
			LEFT JOIN page_connection AS b ON a.id_sub_page=b.id_main_page
			WHERE 
				a.id_main_page = $pageId AND
				a.status = 1
			GROUP BY a.id_sub_page, a.link_text, a.page_order
			ORDER BY a.page_order;		
		";
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}

		$html .= '<ul>';
		while(($tmpData = $this->sqlDB->sql_fetch_row($res))!=false){
			$html .= '<li class="siteMapItem">';
			$html .= '<a href="'.$this->page->getSEOURL($tmpData['id_sub_page']).'" class="mapPage">'.$tmpData['link_text'].'</a>';
			
			if ($tmpData['sub_count']>0) {
				$html .= '<br />';
				$html .= $this->getSiteMapNode($tmpData['id_sub_page']);
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
		
		return $html;
	}
	
	function getSiteMap(){
		global $languages;
		$html = '';
		
		reset($languages);
		while(list($tmpPageId,$tmpLang)=each($languages)){
			if($tmpLang == $this->page->lang){
				$html .= $this->getSiteMapNode($tmpPageId);
				break;
			}
		}
				
		
		return $html;
	}
	
	function getNewsList($fromPageId){
		$sql = "
			SELECT b.id, b.title, date(b.created) AS created, c.property_value AS prefix
			FROM page_connection AS a 
			LEFT JOIN page AS b ON a.id_sub_page = b.id
			LEFT JOIN page_properties AS c ON b.id = c.id_page AND c.property_name = 'prefix'
			WHERE
				a.status = 1 AND
				b.status = 1 AND
				a.id_main_page = $fromPageId
			ORDER BY b.created DESC;
		";
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}
		
		while (($tmpData = $this->sqlDB->sql_fetch_row($res))!=false) {
			$link = $this->page->getURL(array('pageId'=>$tmpData['id']));
			$html .= '
				<p>
					<a href="'.$link.'" class="newsTitle">'.$tmpData['title'].'</a><br />
					'.implode(".", array_reverse(explode("-",$tmpData['created']))).' - '.strip_tags($tmpData['prefix'], '<b><i><u>').'
				</p>
			';
		}
		
		return $html;
	}
	
	function getPath($pageId=null, &$path){
		$pagesPath = $this->page->getPagesPath($pageId);
		
		while(list(, $pId)=each($pagesPath)){
			$pData = $this->getPageData($pId);
			
			//$tmpPath = '<a href="'.$this->page->getUrl(array('pageId'=>$pId)).'" class="topLinks">'.$pData['title'].'</a>';
            //SEOlink
            $tmpPath = '<a href="'.$this->page->getSEOURL($pId).'" class="topLinks">'.$pData['title'].'</a>';            
			if($path!=''){
				// separator
				$tmpPath = ' <img src="/pics/system/arrow.gif" width="9" height="8" alt="|" class="pagePathSep"> '.$tmpPath ;
			}
			$path = $path.$tmpPath;
		}               
	}
         
    function getMainPageId($page_id=null, $startFrom=null){
		global $languages;
		
		$sqlObj = new sql();
		
		if ($page_id==null) {
			return false;
		}
		
		if($startFrom==null){
			$sql = "
				SELECT id_sub_page
				FROM page_connection
				WHERE id_main_page in (0);
			";
		}else{
			$sql = "
				SELECT id_sub_page
				FROM page_connection
				WHERE id_main_page in ($startFrom);
			";
		}
                        
        $res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}
			
		$mainPageIds = null;
		while(($tmpData = $this->sqlDB->sql_fetch_row($res))!=false){
			$mainPageIds[] = $tmpData['id_sub_page'];
		}

		if(in_array($page_id, $mainPageIds) OR $page_id==0){
			return $page_id;
		}
	
		$sql = "
			SELECT id_main_page
			FROM page_connection
			WHERE id_sub_page = $page_id
		";
        
		$res = $sqlObj->sql_query($sql);
		if ($res==false) {
			return false;
		}
		$data = $sqlObj->sql_fetch_row($res);
		$hlPageId = $data[0];
		if(!in_array($hlPageId,$mainPageIds)){
			$hlPageId = $this->getMainPageId($hlPageId, $startFrom);
		}
	    
        return $hlPageId;  
	}
	
	function cutStr2Len($str=null, $len=null, $addToEnd=''){
		if($str==null)
		return false;
		if($len==null)
		return $str;

		if (strlen($str)<=$len) {
			return $str;
		}

		$strParts = explode(" ",$str);
		$output = '';
		while(list($i, $subStr) = each($strParts)){
			if(strlen($output.' '.$subStr)<=$len){
				$output .= ' '.$subStr;
			}else{
				break;
			}
		}

		return $output.$addToEnd;
	}
	
    
	///////////////////////////////////////////////////////////
    
    function mail_attach_new($to, $from, $subject, $message, $file) {
		$mail = new SMTP;
		$from = "server@emm.sk";
		if (!$file == ''){
			$mail->AttachFile($file) OR die('Nepodarilo sa pripojit subor!');
			//$mail->AttachFile($file, false, 'autodetect', 'inline', '8bit') OR die('Nepodarilo sa pripojit subor!');
		}
		$mail->Delivery('relay');
		@$mail->Relay('mail.netropolis.sk', 'emm-smtp@office.netropolis.sk', 'kafj48zk214', 465, 'autodetect', 'ssl');
		@$mail->From($from);
		@$mail->AddTo($to);
		$mail->Text($message,"UTF-8");
		
		$sent = $mail->send($subject,"UTF-8");	
	}
    
    function getForm($langID){
   	
		$lang['servicing_sheet'][1]='Servisný formulár';
		$lang['client_identification_data'][1]='Identifikačné údaje klienta';
		$lang['name_of_company'][1]='Názov firmy';
		$lang['client_identify'][1]='Číslo zmluvy';
		$lang['reported_by'][1]='Nahlasovateľ';
		$lang['failure_type'][1]='Typ problému(HW,SW,EZS,EPS,iné)';
		$lang['possible_time'][1]='Možný čas zásahu';
		$lang['recipient'][1]='Príjemca';
		$lang['choose_recipient'][1]='Vyberte si príjemcu';
		$lang['it_division'][1]='servis informačných systémov';
		$lang['security_systems'][1]='servis bezpečnostných systémov a servis pre technickú bezpečnosť';
		$lang['technical_and_object_security'][1]='Úsek technickej a objektovej bezpečnosti';
		$lang['product_information_data'][1]='Identifikačné údaje produktu';
		$lang['name_or_type'][1]='Názov alebo typ:';
		$lang['manufacturing_license_number'][1]='Výrobné alebo licenčné číslo';
		$lang['product_supplied'][1]='Dátum dodanie produktu';
		$lang['version'][1]='Verzia';
		$lang['the_product_is_under_warranty'][1]='Produkt je v záruke(áno-nie)';
		$lang['product_location_address'][1]='Adresa umietnenia produktu';
		$lang['priority'][1]='Priorita';
		$lang['insignificant'][1]='Nevýznamná';
		$lang['normal'][1]='Bežná';
		$lang['critical'][1]='Kritická';
		$lang['failure_description'][1]='Popis problému:';
		$lang['obligatory_data'][1]='povinné údaje';
		$lang['indicate_visualisation'][1]='Zadajte vizualizačný kód';
		$lang['send'][1]='Pošli';
		$lang['wrong_input'][1]='Nevyplnili ste všetky povinné údaje, alebo ste nezadali správne vyzualizačný kód!';   
		$lang['send_ok'][1]='Vaša žiadosť bola úspešne odoslaná!';             
	
		$lang['servicing_sheet'][2]='Servicing sheet';
		$lang['client_identification_data'][2]='Client identification data';
	        $lang['client_identify'][2]='Contract No.';
		$lang['name_of_company'][2]='Name of company';
		$lang['contract_no'][2]='Contract No.';
		$lang['reported_by'][2]='Reported by';
		$lang['failure_type'][2]='Failure type (HW,SW, electronic security system, electronic fire alarm system, other)';
		$lang['possible_time'][2]='Possible time of remedy';
		$lang['recipient'][2]='Recipient';
		$lang['choose_recipient'][2]='Choose the recipient';
		$lang['it_division'][2]='Information system servicing';
		$lang['security_systems'][2]='Technical and object security servicing';
		$lang['technical_and_object_security'][2]='Technical and object security department';
		$lang['product_information_data'][2]='Product identification data';
		$lang['name_or_type'][2]='Name or type';
		$lang['manufacturing_license_number'][2]='Manufacturing or licence number';
		$lang['product_supplied'][2]='Product supplied on (date)';
		$lang['version'][2]='Version';
		$lang['the_product_is_under_warranty'][2]='The product is under warranty (yes – no)';
		$lang['product_location_address'][2]='Product location address';
		$lang['priority'][2]='Priority';
		$lang['insignificant'][2]='insignificant';
		$lang['normal'][2]='normal';
		$lang['critical'][2]='critical';
		$lang['failure_description'][2]='Failure description';
		$lang['obligatory_data'][2]='obligatory data';
		$lang['indicate_visualisation'][2]='Indicate the visualisation code';
		$lang['send'][2]='Send';
		$lang['wrong_input'][2]='You don\'t fill all obligatory data or insert wrong visualisation code!';   
		$lang['send_ok'][2]='Message was send';             
	

 	
    	$lb="\n";
    	$sendButton = strip_tags($_POST['submitform']);
  		
  		if (isset($sendButton) AND $sendButton=="submitform") {
  			$firma = strip_tags($_POST['firma']);
  			$zmluva = strip_tags($_POST['zmluva']);
  			$nahlasovatel = strip_tags($_POST['nahlasovatel']);
  			$tel = strip_tags($_POST['tel']);
  			$email = strip_tags($_POST['email']);
  			$problem = strip_tags($_POST['problem']);
  			$cas = strip_tags($_POST['cas']);
  			$prijemca = strip_tags($_POST['prijemca']);
  			$nazovtyp = strip_tags($_POST['nazovtyp']);
  			$licencia = strip_tags($_POST['licencia']);
  			$datum = strip_tags($_POST['datum']);
  			$verzia = strip_tags($_POST['verzia']);
  			$zaruka = strip_tags($_POST['zaruka']);
  			$umiestnenie = strip_tags($_POST['umiestnenie']);
  			$priorita = strip_tags($_POST['priorita']);
  			$popis = strip_tags($_POST['popis']);

  				if (($firma!='')&&($nahlasovatel!='')&&($tel!='')&&($prijemca!='')&&($nazovtyp!='')&&($umiestnenie!='')&&($_POST['code']!='')&&(PhpCaptcha::Validate($_POST['code']))){
  					$message .='Formulár z časti "On-line registrácia servisnej požiadavky" '.$lb.$lb;
  					$message .='Identifikačné údaje klienta: '.$lb.$lb;
  					
  					$message .='Názov firmy : '.$firma.$lb;
  					$message .='Číslo zmluvy : '.$zmluva.$lb;
  					$message .='Nahlasovateľ : '.$nahlasovatel.$lb;
  					$message .='Tel./Fax : '.$tel.$lb;
  					$message .='Email : '.$email.$lb;
  					$message .='Typ problému(HW,SW,EZS,EPS,iné) : '.$problem.$lb;
  					$message .='Možný čas zásahu : '.$cas.$lb;
  					$message .='Príjemca : '.$prijemca.$lb.$lb;
  					
  					$message .='Identifikačné údaje produktu:'.$lb.$lb;
  					
  					$message .='Názov alebo typ : '.$nazovtyp.$lb;
  					$message .='Výrobné alebo licenčné číslo : '.$licencia.$lb;
  					$message .='Dátum dodanie produktu : '.$datum.$lb;
  					$message .='Verzia : '.$verzia.$lb;
  					$message .='Produkt je v záruke(áno-nie) : '.$zaruka.$lb;
  					$message .='Adresa umietnenia produktu : '.$umiestnenie.$lb;
  					$message .='Priorita : '.$priorita.$lb;
  					$message .='Popis problému : '.$popis.$lb;
  			
					if ($prijemca == 2) { $sendTo='servisis@emm.sk'; }
					if ($prijemca == 3) { $sendTo='servisbs@emm.sk'; }

					$this->mail_attach_new($sendTo, $email, 'EMM', $message,'');	
					$html .= '<br clear="all"><center class="relativemessage"><b style="line-height: 2em;color:green;">'.$lang['send_ok'][$langID].'</b></center><br clear="all">';
					
		  			$firma = "";
		  			$zmluva = "";
		  			$nahlasovatel = "";
		  			$tel = "";
		  			$email = "";
		  			$problem = "";
		  			$cas = "";
		  			$prijemca = "";
		  			$nazovtyp = "";
		  			$licencia = "";
		  			$datum = "";
		  			$verzia = "";
		  			$zaruka = "";
		  			$umiestnenie = "";
		  			$priorita = "";
		  			$popis ="";
  				}
  				else{
  					$html .= '<br clear="all" /><center class="relativemessage"><b style="line-height: 2em;color:red;">'.$lang['wrong_input'][$langID].'</b></center><br clear="all" />';
  					
  				}
  					
  		}
  					
  		if($prijemca=="2"){ $selected1=" selected='selected'"; };
  		if($prijemca=="3"){ $selected2=" selected='selected'"; };
  		if($prijemca=="4"){ $selected3=" selected='selected'"; };
  		
  		if($priorita=="2"){ $selected21=" selected='selected'"; };
  		if($priorita=="3"){ $selected22=" selected='selected'"; };
  		if($priorita=="4"){ $selected23=" selected='selected'"; };
    		$html .='
  			<form action="" method="POST">	
  				<table class="form-table" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td class="stlpec1">
							<h4>'.$lang['client_identification_data'][$langID].':</h4><br /><br />
							'.$lang['name_of_company'][$langID].': <span style="color:#F6921D;">*</span><br />
							<input class="inputik" type="text" name="firma" value="'.$firma.'">
							<br />
							'.$lang['client_identify'][$langID].': <br />
							<input class="inputik" type="text" name="zmluva" value="'.$zmluva.'">
							<br />
							'.$lang['reported_by'][$langID].': <span style="color:#F6921D;">*</span><br />
							<input class="inputik" type="text" name="nahlasovatel" value="'.$nahlasovatel.'">
							<br />
							Tel./Fax: <span style="color:#F6921D;">*</span><br />
							<input class="inputik" type="text" name="tel" value="'.$tel.'">
							<br />
							Email: <br />
							<input class="inputik" type="text" name="email" value="'.$email.'">
							<br />
							'.$lang['failure_type'][$langID].':  <br />
							<input class="inputik" type="text" name="problem" value="'.$problem.'">
							<br />
							<br />
							<br />
							<br />
							'.$lang['possible_time'][$langID].':  <br />
							<input class="inputik" type="text" name="cas" value="'.$cas.'">
							<br />
										</td>
						
						<td class="stlpec2">
							<h4>'.$lang['product_information_data'][$langID].':</h4><br /><br />
							'.$lang['name_or_type'][$langID].': <span style="color:#F6921D;">*</span><br />
							<input class="inputik" type="text" name="nazovtyp" value="'.$nazovtyp.'">
							<br />
							'.$lang['manufacturing_license_number'][$langID].': <br />
							<input class="inputik" type="text" name="licencia" value="'.$licencia.'">
							<br />
							'.$lang['product_supplied'][$langID].': <br />
							<input class="inputik" type="text" name="datum" value="'.$datum.'">
							<br />
							'.$lang['version'][$langID].': <br />
							<input class="inputik" type="text" name="verzia" value="'.$verzia.'">
							<br />
							'.$lang['the_product_is_under_warranty'][$langID].': <br />
							<input class="inputik" type="text" name="zaruka" value="'.$zaruka.'">
							<br />
							'.$lang['product_location_address'][$langID].': <span style="color:#F6921D;">*</span><br />
							<input class="inputik" type="text" name="umiestnenie" value="'.$umiestnenie.'">
							<br />
							'.$lang['priority'][$langID].':<br />
							<select class="selektik" name="priorita" >
								<option value="">'.$lang['normal'][$langID].'</option>
								<option value="2" '.$selected21.'>'.$lang['critical'][$langID].'</option>
								<option value="3" '.$selected22.'>'.$lang['failure_description'][$langID].'</option>
							</select>
							<br /><br />
							'.$lang['failure_description'][$langID].': <br />
							<textarea name="popis">'.$popis.'</textarea>
							
						</td>
						
						<td class="stlpec3">

							<span style="color:#F6921D;">'.$lang['obligatory_data'][$langID].'*</span>
							<br />
							<br />
							<img src="/include/captcha/captcha.php" alt=""><br />
							'.$lang['indicate_visualisation'][$langID].':  <span style="color:#F6921D;">*</span><br />
							<input class="inputikcode" type="text" name="code" value="">
							<br />
							<br />
							<input type="hidden" name="submitform" value="submitform">
							<input class="submitform" type="submit" name="submitsubmitform" value="'.$lang['send'][$langID].'">
						
						</td>
					</tr>
					<tr><td colspan="3">
							'.$lang['recipient'][$langID].' <span style="color:#F6921D;">*</span><br />
							<select class="selektik" name="prijemca" style="width: 400px;">
								<option value="">'.$lang['choose_recipient'][$langID].'</option>
								<option value="2" '.$selected1.'>'.$lang['it_division'][$langID].'</option>
								<option value="3" '.$selected2.'>'.$lang['security_systems'][$langID].'</option>
							</select>
						</td>
					</tr>
				</table>
			</form>
		';
    	return $html;
    }
    
    function ClasicPageContent($title , $body){
    	$html = "";	
    	$i=rand(1,12);
    	$html .='<div id="inner_header" style="background-image: url(\'/pics/subpage/'.$i.'.jpg\')"><h1>'.$title.'</h1></div>
    					<div>'.$body.'</div>';
    	
			return $html;		
    }
    
    function getNovinkyYear($lang){

		if ($lang=='en') {
			$mainPageId = 202;
		}
		else {
			$mainPageId = 48;
		}
		$sql = "
			SELECT DISTINCT date_part('year', TIMESTAMPTZ (c.created)) as rok
			FROM page_connection AS c
			WHERE
				c.id_main_page = $mainPageId
			ORDER BY rok DESC
		";
		//echo $sql;
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}
		$pole  =array();
		$i = 0;
		while (($tmpData = $this->sqlDB->sql_fetch_row($res))!=false) {
			$pole[$i] = $tmpData['rok'];
			$i++;
		}
    	
    	return $pole;
    }
    
    function getNovinkyPodlaRoku($rok,$lang){
    	$html = "";
    	
	if ($lang=='en') {
			$mainPageId = 202;
		}
		else {
			$mainPageId = 48;
		}
		
    	$from = "$rok-01-01";
    	$to = "$rok-12-31";
    	
    	$sql = "
			SELECT c.link_text, c.id_sub_page
				FROM page_connection AS c
			WHERE
				c.created >= '$from' AND
				c.created <= '$to' AND
    			c.id_main_page = $mainPageId AND
			c.status = 1	
			ORDER BY c.created DESC
		";
    	
    	//echo nl2br($sql);
    	
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}

		$html .= '<ul class="zoznamNoviniek">';
		while (($tmpData = $this->sqlDB->sql_fetch_row($res))!=false) {
			//print_r($tmpData);
			$html .='
				<li><a href="'.$this->page->getSEOURL($tmpData['id_sub_page']).'">'.$tmpData['link_text'].'</a></li>
				
			';
		}
    	
    	return $html;
    }
 
    function getNovinky($lang){
    	$html = "";
    	$pole = array();
    	$pole = $this->getNovinkyYear($lang);

    	if ($lang=='en') {
    		//$trans[0]='News for year ';
    		$trans[0]='Year ';
    	}
    	else {
    		$trans[0]='Rok ';
    		//$trans[0]='Novinky za rok';
    	}
	
    	$body = '<div id="zoznamRokov">';
    	foreach ($pole as $item) {
    		$body .= '<a class="novinkyroky" href="?nyear='.$item.'">'.$item.'</a>';
    	}
    	$body .= '</div>';
    		
    	$rok = strip_tags(trim($_GET['nyear']));
    	if ($rok == ""){$rok = $pole[0];}
    	
		$body .= '
			<div id="sccontent">
			<h3>'.$trans[0].' '.$rok.'</h3>
			<br />
		';
    	
    	$body .=$this->getNovinkyPodlaRoku($rok,$lang);
		
    	$body.="	</div>
    	";
    	
    	$pom="";
    	for ($i=0;$i<30;$i++) $pom.="<br />";
    	if (strlen($body)<2000) $body .= $pom;
    	
    	$html .='
    		<h1>'.$title.'</h1>
    		<div style="padding-top: 20px;">'.$body.'</div>
    	';	
    	
    	return $html;
    }
	
  function getBackToNewsLink($created,$lang)
  {
    $date = explode('-',$created);
    $rok = $date[0];

    if ($lang==2) {
      $html = '<a href="'.$this->page->getSEOURL(202).'?nyear='.$rok.'">Back to archive list for year '.$rok.'</a>';
    }
    else {
      $html = '<a href="'.$this->page->getSEOURL(48).'?nyear='.$rok.'">Späť na zoznam noviniek za rok '.$rok.'</a>';
    }

  	return $html;
  }

  function GetSubPageLinks($page_id)
  {
    $sql = "
			SELECT a.id_sub_page, a.link_text, count(b.id_sub_page) AS sub_count
			FROM page_connection AS a
			LEFT JOIN page_connection AS b ON a.id_sub_page=b.id_main_page
			WHERE a.id_main_page = $page_id AND a.status = 1
			GROUP BY a.id_sub_page, a.link_text, a.page_order
			ORDER BY a.page_order;
		";

		$res = $this->sqlDB->sql_query($sql);

    if($res==false) return false;
		if($this->sqlDB->sql_num_rows($res)==0) return '';

    $html = '<div id="sub_page_links">';
    $html .= ($this->page->lang=='sk_SK') ? '<span class="title">Ponúkame Vám</span>' : '<span class="title">Our services</span>';
    $html .= '<ul>';

		while(($tmpData = $this->sqlDB->sql_fetch_row($res))!=false)
    {
			$html .= '<li><a href="'.$this->page->getSEOURL($tmpData['id_sub_page']).'">'.strip_tags($tmpData['link_text']).'</a></li>';
		}

    return $html .= '</ul></div>';
  }

  function GetFlexLoginForm()
  {
    require_once(DOCROOT.'/include/core/form.php');

    $form = new NetForm('flexlogin');
    $form->Load();

    $html .= '<label onclick="DisableForms();"><input type="checkbox" id="force_download" name="force_download" value="true" onclick="DisableForms();" /> Licenčný kľúč už mám, stiahnuť bez vyplnenia formulára</label><br /><br />';

    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td style="width: 105px;"><label>Právna forma *</label></td>';
    $html .= '<td>';
    $html .= '<label onclick="ShowForm(1);"><input type="radio" name="pr_forma"'.(($form->pr_forma=='fo' || $form->pr_forma=='') ? ' checked="checked"' : '').' onclick="ShowForm(1);" />Fyzická osoba</label><br />';
    $html .= '<label onclick="ShowForm(2);"><input type="radio" name="pr_forma"'.(($form->pr_forma=='po') ? ' checked="checked"' : '').' onclick="ShowForm(2);" />Právnická osoba</label>';
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</table>';

    // FO
    $html .= '<form id="form_fo" style="'.(($form->pr_forma=='fo' || $form->pr_forma=='') ? 'display:block;' : 'display:none;').'" action="/actions/flexlogin.php" method="post" onsubmit="return ValidateForm(this);">';
    $html .= '<table>';

    $html .= '<tr>';
    $html .= '<td style="width: 105px;"><label for="field_meno">Meno *</label><input type="hidden" name="pr_forma" value="fo" /></td>';
    $html .= '<td><input type="text" id="field_meno" name="meno" title="Meno" value="'.htmlspecialchars($form->meno).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_email">E-Mail *</label></td>';
    $html .= '<td><input type="text" id="field_email" name="email" title="E-Mail" value="'.htmlspecialchars($form->email).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_email_check">E-Mail - kontrola *</label></td>';
    $html .= '<td><input type="text" id="field_email_check" name="email_check" title="E-Mail - kontrola" value="'.htmlspecialchars($form->email_check).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_adresa">Adresa *</label></td>';
    $html .= '<td><input type="text" id="field_adresa" name="adresa" title="Adresa" value="'.htmlspecialchars($form->adresa).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_mesto">Mesto *</label></td>';
    $html .= '<td><input type="text" id="field_mesto" name="mesto" title="Mesto" value="'.htmlspecialchars($form->mesto).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_psc">PSČ *</label></td>';
    $html .= '<td><input type="text" id="field_psc" name="psc" title="PSČ" value="'.htmlspecialchars($form->psc).'" maxlength="20" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_stat">Štát *</label></td>';
    $html .= '<td><input type="text" id="field_stat" name="stat" title="Štát" value="'.htmlspecialchars($form->stat).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_telefon">Telefón</label></td>';
    $html .= '<td><input type="text" id="field_telefon" name="telefon" title="Telefón" value="'.htmlspecialchars($form->telefon).'" maxlength="50" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_verzia">Verzia inštalátora *</label></td>';
    $html .= '<td><select id="field_verzia" name="verzia" title="Verzia inštalátora"><option value="32">Windows 32 bit</option><option value="64">Windows 64 bit</option></select></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>&nbsp;</td>';
    $html .= '<td><button type="submit" name="submit">Stiahnuť</button>';
    $html .= '</tr>';

    $html .= '</table>';
    $html .= '</form>';

    // PO
    $html .= '<form id="form_po" style="'.(($form->pr_forma=='po') ? 'display:block;' : 'display:none;').'" action="/actions/flexlogin.php" method="post" onsubmit="return ValidateForm(this);">';
    $html .= '<table>';

    $html .= '<tr>';
    $html .= '<td style="width: 105px;"><label for="field_nazov">Názov *</label><input type="hidden" name="pr_forma" value="po" /></td>';
    $html .= '<td><input type="text" id="field_nazov" name="nazov" title="Názov" value="'.htmlspecialchars($form->nazov).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_email">E-Mail *</label></td>';
    $html .= '<td><input type="text" id="field_email" name="email" title="E-Mail" value="'.htmlspecialchars($form->email).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_email_check">E-Mail - kontrola *</label></td>';
    $html .= '<td><input type="text" id="field_email_check" name="email_check" title="E-Mail - kontrola" value="'.htmlspecialchars($form->email_check).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_adresa">Adresa *</label></td>';
    $html .= '<td><input type="text" id="field_adresa" name="adresa" title="Adresa" value="'.htmlspecialchars($form->adresa).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_mesto">Mesto *</label></td>';
    $html .= '<td><input type="text" id="field_mesto" name="mesto" title="Mesto" value="'.htmlspecialchars($form->mesto).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_psc">PSČ *</label></td>';
    $html .= '<td><input type="text" id="field_psc" name="psc" title="PSČ" value="'.htmlspecialchars($form->psc).'" maxlength="20" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_stat">Štát *</label></td>';
    $html .= '<td><input type="text" id="field_stat" name="stat" title="Štát" value="'.htmlspecialchars($form->stat).'" maxlength="50" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_ico">IČO *</label></td>';
    $html .= '<td><input type="text" id="field_ico" name="ico" title="IČO" value="'.htmlspecialchars($form->ico).'" maxlength="20" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_dic">DIČ *</label></td>';
    $html .= '<td><input type="text" id="field_dic" name="dic" title="DIČ" value="'.htmlspecialchars($form->dic).'" maxlength="20" class="required" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_ic_dph">IČ DPH</label></td>';
    $html .= '<td><input type="text" id="field_ic_dph" name="ic_dph" title="IČ DPH" value="'.htmlspecialchars($form->ic_dph).'" maxlength="20" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_penazny_ustav">Peňažný ústav</label></td>';
    $html .= '<td><input type="text" id="field_penazny_ustav" name="penazny_ustav" title="Peňažný ústav" value="'.htmlspecialchars($form->penazny_ustav).'" maxlength="50" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_cislo_uctu">Číslo účtu</label></td>';
    $html .= '<td><input type="text" id="field_cislo_uctu" name="cislo_uctu" title="Číslo účtu" value="'.htmlspecialchars($form->cislo_uctu).'" maxlength="50" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_telefon">Telefón</label></td>';
    $html .= '<td><input type="text" id="field_telefon" name="telefon" title="Telefón" value="'.htmlspecialchars($form->telefon).'" maxlength="50" /></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><label for="field_verzia">Verzia inštalátora *</label></td>';
    $html .= '<td><select id="field_verzia" name="verzia" title="Verzia inštalátora"><option value="32">Windows 32 bit</option><option value="64">Windows 64 bit</option></select></td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>&nbsp;</td>';
    $html .= '<td><button type="submit" name="submit">Stiahnuť</button>';
    $html .= '</tr>';

    $html .= '</table>';
    $html .= '</form>';

    $html .= '
      <script type="text/javascript">
      /*<![CDATA[*/
      function ValidateForm(form)
      {
        var x = 0;

        while((x < form.elements.length))
        {
          if(!form.elements[x].disabled && form.elements[x].value==\'\' && form.elements[x].className.indexOf(\'required\')!=-1)
          {
            alert(\'Prosím zadajte hodnotu v poli "\'+form.elements[x].title+\'"\');
            form.elements[x].focus();
            return false;
          }

          x++;
        }

        if(form.elements[2].value!=form.elements[3].value)
        {
          alert(\'Zadané e-maily sa musia zhodovať\');
          form.elements[2].focus();
          return false;
        }

        alert("Na adresu, ktorú ste uviedli, Vám bol zaslaný e-mail s Vašim licenčným kľúčom a variabilným symbolom. Aby bola inštalácia úspešná, aktivujte svoj licenčný kľúč uhradením zálohovej faktúry, ktorá Vám bola tiež zaslaná. V platbe uveďte Váš variabilný symbol.");
        return true;
      }

      function ShowForm(f)
      {
        var f_fo = document.getElementById(\'form_fo\');
        var f_po = document.getElementById(\'form_po\');

        if(f==1) { f_fo.style.display = "block"; f_po.style.display = "none"; }
        else { f_fo.style.display = "none"; f_po.style.display = "block"; }
      }

      function DisableForms(e)
      {
        var f_fo = document.getElementById(\'form_fo\');
        var f_po = document.getElementById(\'form_po\');
        var e = document.getElementById(\'force_download\');
        var dis = e.checked;

        var x = 0;
        while((x < f_fo.elements.length))
        {
          name = f_fo.elements[x].name;
          if(name!="verzia" && name!="submit") f_fo.elements[x].disabled = dis;

          x++;
        }

        var x = 0;
        while((x < f_po.elements.length))
        {
          name = f_po.elements[x].name;
          if(name!="verzia" && name!="submit") f_po.elements[x].disabled = dis;

          x++;
        }
      }
      /*]]>*/
      </script>

      <br /><br />
      <h2>Pokyny k inštalácii súboru na prevzatie:</h2>
      <ol>
        <li>Dvakrát kliknite na programový súbor FlexLogin_WinXXSetup.exe na pevnom disku, čím spustíte inštalačný program. </li>
        <li>Podľa pokynov na obrazovke dokončite inštaláciu.</li>
      </ol>

      <h2>Odstránenie prevzatého súboru:</h2>
      <ol>
        <li>V operačnom systéme Windows kliknite v ponuke Štart na položku Ovládací panel.</li>
        <li>Vyberte položku Pridať alebo odstrániť programy.</li>
        <li>V zozname aktuálne nainštalovaných programov vyberte položku FlexLogin a potom kliknite na tlačidlo Odstrániť alebo Pridať alebo odstrániť. Keď sa zobrazí dialógové okno, postupujte podľa pokynov na odstránenie programu.</li>
        <li>Kliknutím na tlačidlo Áno alebo OK potvrďte, že chcete program odstrániť.</li>
      </ol>

      <h2>Systémové požiadavky</h2>
      <ul>
        <li>Podporované operačné systémy: Windows Server 2003, Windows Server 2008, Windows Vista; Windows Vista Service Pack 1; Windows XP Service Pack 3, Windows 7</li>
      </ul>';

    return $html;
  }

	///////////////////////////////////////////////////////////
    
	
	function getTHML(){
		$html = '';
		
		$this->page		= &$this->templateObject->pageObject;
		$this->auth 	= &$this->templateObject->pageObject->authentication; 		

		$pageData = $this->getPageData($this->page->pageId);
		$pagesPath = $this->page->getPagesPath($this->page->pageId);

    $page_id = $this->page->pageId;
	//echo $page_id;

		$this->getPath($this->page->pageId, $path);
		switch ($this->page->lang){
		case 'sk_SK':
		    $this->languagePage = 6;
		    $this->lang_skratka ='sk';
		    break;
		case 'en_US':
		    $this->languagePage = 12;
		    $this->lang_skratka ='en';
		    break;
		default:
		    $this->languagePage = 6;
		    $this->lang_skratka ='sk';
		    break;
		}

		switch ($pageData['type']){
			case 2:
			case 1:	// obycajna stranka

    	if (in_array(48,$pagesPath)) {
    		$backToNews = $this->getBackToNewsLink($pageData['created']);
    	}
    	elseif (in_array(202,$pagesPath)) {
    		$backToNews = $this->getBackToNewsLink($pageData['created'],2);
    	}
    	else {
    		$backToNews = '';
    	}
	    $html .= $this->ClasicPageContent($pageData['title'],$pageData['body'].$backToNews);

      //if($page_id==305) $html .= $this->GetFlexLoginForm();
      //if($page_id==265) $html .= $this->GetFlexLoginForm();

      if($page_id==68 || $page_id==66 || $page_id==67 || $page_id==65 || $page_id==159 || $page_id==169 || $page_id==173 || $page_id==188)
        $html .= $this->GetSubPageLinks($page_id);

			break;
				
			case 5: // cast form
				$html .='<h2>'.$pageData['title'].'</h2>';
				if ($this->page->pageId==249) {
					$html .= $this->getForm(2);
				}
				else {
					$html .= $this->getForm(1);
				}
				break;
			case 6: // cast noviky
				$html .='<h1>Archív noviniek</h1><br />';
				$html .= $this->getNovinky();
				break;
			case 7: // cast noviky
				$html .='<h1>News archive</h1><br />';
				$html .= $this->getNovinky('en');
				break;
				
			case 10: // mapa stranok
				$html .= '<h1>'.$pageData['title'].'</h1>';
		        $html .= $pageData['body'];
				$html .= $this->getSiteMap();
				break;
		}
        
		return $html;
	}
}  
?>
