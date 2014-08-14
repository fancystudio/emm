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
		//$this->cart = new cart();
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
				$html .= '<br>';
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
					<a href="'.$link.'" class="newsTitle">'.$tmpData['title'].'</a><br>
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
		if (!$file == ''){
			$mail->AttachFile($file) OR die('Nepodarilo sa pripojit subor!');
			//$mail->AttachFile($file, false, 'autodetect', 'inline', '8bit') OR die('Nepodarilo sa pripojit subor!');
		}
		$mail->Delivery('relay');
		@$mail->Relay('office.netropolis.sk', '', '', 25, 'autodetect', 'false');
		@$mail->From($from);
		@$mail->AddTo($to);
		$mail->Text($message,"UTF-8");
		
		$sent = $mail->send($subject,"UTF-8");	
	}
    
    function getForm(){
    	
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
  				
					$this->mail_attach_new('papes@emm.sk', $email, 'EMM', $message,'');	
					$html .= ' <center class="relativemessage"><b style="line-height: 2em;color:green;">Vaša žiadosť bola úspešne odoslaná!</b></center>';
					
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
  					$html .= '<center class="relativemessage"><b style="line-height: 2em;color:red;">Nevyplnili ste všetky povinné údaje, alebo ste nezadali správne vyzualizačný kód!</b></center>';
  					
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
							<h4>Identifikačné údaje klienta:</h4><br><br>
							Názov firmy: <span style="color:#F6921D;">*</span><br>
							<input class="inputik" type="text" name="firma" value="'.$firma.'">
							<br>
							Číslo zmluvy: <br>
							<input class="inputik" type="text" name="zmluva" value="'.$zmluva.'">
							<br>
							Nahlasovateľ: <span style="color:#F6921D;">*</span><br>
							<input class="inputik" type="text" name="nahlasovatel" value="'.$nahlasovatel.'">
							<br>
							Tel./Fax: <span style="color:#F6921D;">*</span><br>
							<input class="inputik" type="text" name="tel" value="'.$tel.'">
							<br>
							Email: <br>
							<input class="inputik" type="text" name="email" value="'.$email.'">
							<br>
							Typ problému(HW,SW,EZS,EPS,iné):  <br>
							<input class="inputik" type="text" name="problem" value="'.$problem.'">
							<br>
							<br>
							<br>
							<br>
							Možný čas zásahu:  <br>
							<input class="inputik" type="text" name="cas" value="'.$cas.'">
							<br>
							Príjemca: <span style="color:#F6921D;">*</span><br>
							<select class="selektik" name="prijemca" >
								<option value="">Vyberte si príjemcu</option>
								<option value="2" '.$selected1.'>2</option>
								<option value="3" '.$selected2.'>3</option>
								<option value="4" '.$selected3.'>4</option>
							</select>
						</td>
						
						<td class="stlpec2">
							<h4>Identifikačné údaje produktu:</h4><br><br>
							Názov alebo typ: <span style="color:#F6921D;">*</span><br>
							<input class="inputik" type="text" name="nazovtyp" value="'.$nazovtyp.'">
							<br>
							Výrobné alebo licenčné číslo: <br>
							<input class="inputik" type="text" name="licencia" value="'.$licencia.'">
							<br>
							Dátum dodanie produktu: <br>
							<input class="inputik" type="text" name="datum" value="'.$datum.'">
							<br>
							Verzia: <br>
							<input class="inputik" type="text" name="verzia" value="'.$verzia.'">
							<br>
							Produkt je v záruke(áno-nie): <br>
							<input class="inputik" type="text" name="zaruka" value="'.$zaruka.'">
							<br>
							Adresa umietnenia produktu:  <span style="color:#F6921D;">*</span><br>
							<input class="inputik" type="text" name="umiestnenie" value="'.$umiestnenie.'">
							<br>
							Priorita:<br>
							<select class="selektik" name="priorita" >
								<option value="">Nevýznamná</option>
								<option value="2" '.$selected21.'>2</option>
								<option value="3" '.$selected22.'>3</option>
								<option value="4" '.$selected23.'>4</option>
							</select>
							<br><br>
							Popis problému: <br>
							<textarea name="popis">'.$popis.'</textarea>
							
						</td>
						
						<td class="stlpec3">

							<span style="color:#F6921D;">povinné údaje*</span>
							<br>
							<br>
							<img src="/include/captcha/captcha.php"><br>
							Zadajte vizualizačný kód:  <span style="color:#F6921D;">*</span><br>
							<input class="inputikcode" type="text" name="code" value="">
							<br>
							<br>
							<input type="hidden" name="submitform" value="submitform">
							<input class="submitform" type="submit" name="submitsubmitform" value="Pošli">
						
						</td>
					</tr>
				</table>
			</form>
		';
    	return $html;
    }
    
    function ClasicPageContent($title , $body){
    	$html = "";	
    	$cislo = rand(1,5);
    	$html .='<h1>'.$title.'</h1><br>';
    	/*
    	$html .='
    		<div id="scrollArea">
    			<div id="sccontent-top-sipka"></div>
    			<div style="height: 20px; left: 0px; top: 0px;" id="scroller"></div>
    			<div id="sccontent-bottom-sipka"></div>
    		</div>
    			
			<div id="sccontainer">
				<div id="sccontent">	
					<img src="/pics/picture'.$cislo.'.jpg" alt="" align="right" border="0">
					'.$body.'
				</div>
			</div>
    	';
    	*/
    	
    	$pom="";
    	for ($i=0;$i<30;$i++) $pom.="<br>";
    	if (strlen($body)<2000) $body .= $pom;
    	
    	$html .='
			<script src="/include/scrollable_div/urchin.js" type="text/javascript"></script>
			<script type="text/javascript" src="/include/scrollable_div/scrollable_div.js"></script>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div style="top: 0px;" id="scrolldiv_content">
		    			<img src="/pics/picture'.$cislo.'.jpg" height="192" width="192" alt="" border="0" style="float: right; position: relative;">
		    			'.$body.'
					</div>
				</div>
				<div style="height: 400px;" id="scrolldiv_slider">
				<div style="height: 400px;" id="scrolldiv_slider">
					<div id="scrolldiv_scrollUp"><img src="/pics/arrow_up.gif"></div>
					<div id="scrolldiv_scrollbar">
						<div id="scrolldiv_theScroll"><span></span></div>
					</div>
					<div id="scrolldiv_scrollDown"><img src="/pics/arrow_down.gif"></div>
				</div>
				</div>
			</div>
		';
		
    	$html .='
			<script type="text/javascript">
				scrolldiv_setColor(\'#F6921D\');	// Setting color of the scrolling div
				setSliderBgColor(\'#E6E6E7\');	// Setting color of the scrolling div
				setContentBgColor(\'#FFFFFF\');	// Setting color of the scrolling div
				setScrollButtonSpeed(1);	// Setting speed of scrolling when someone clicks on the arrow or the slider
				setScrollTimer(5);	// speed of 1 and timer of 5 is the same as speed of 2 and timer on 10 - whats the difference? 1 and 5 will make the scroll move a little smoother.
				scrolldiv_setWidth(750);	// Setting total width of scrolling div
				scrolldiv_setHeight(400);	// Setting total height of scrolling div
				scrolldiv_initScroll();	// Initialize javascript functions
			</script>
			
			<script language="JavaScript" src="/include/scrollable_div/KonaLibInline.js"></script><script language="JavaScript" src="/include/scrollable_div/KonaLibBaseRM.js"></script><a href="#" target="_top" id="AdLinkLayerClick"></a>
			<script type="text/javascript" src="/include/scrollable_div/KonaLib_TreeCoreRM.js"></script>
			<script type="text/javascript" src="/include/scrollable_div/KonaGatewayCheck.js"></script>
		';
    	
    	
    	
		return $html;		
    }
    
    function getNovinkyYear(){
		$sql = "
			SELECT DISTINCT date_part('year', TIMESTAMPTZ (c.created)) as rok
			FROM page_connection AS c
			WHERE
				c.id_main_page = 48
			ORDER BY rok
		";
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
    
    function getNovinkyPodlaRoku($rok){
    	$html = "";
    	
    	$today = "$rok-01-01";
    	
    	$sql = "
			SELECT c.link_text, c.id_sub_page
				FROM page_connection AS c
			WHERE
				$today < c.created 
    			AND	
    			c.id_main_page = 48	
			ORDER BY c.created
		";
    	
    	//echo $sql;
    	
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}

		while (($tmpData = $this->sqlDB->sql_fetch_row($res))!=false) {
			//print_r($tmpData);
			$html .='
				<h4><a href="'.$this->page->getSEOURL($tmpData['id_sub_page']).'">'.$tmpData['link_text'].'</a></h4>
				
			';
			$pageData = $this->getPageData($tmpData['id_sub_page']); 
			$html .='<div style="margin-bottom:10;">'.$this->cutStr2Len($pageData['body'],100,'...').'</div>'; 
		}
    	
    	return $html;
    }
 
    function getNovinky(){
    	$html = "";
    	$pole = array();
    	$pole = $this->getNovinkyYear();
    	
    	//$html  .= 'Archýv obsahuje novinky z rokov:';
    	$i = 0;
    	
    	
    	While($pole[$i] != ""){
    		
    		$body='
						<div id="sccontent">
    					<h3><a class="novinkyroky" href="?nyear='.$pole[$i].'">'.$pole[$i].'</a></h3>
    					<br>
    			';
    		$i++;
    	}
    	
    	$rok = strip_tags(trim($_GET['nyear']));
    	if ($rok == ""){$rok = $pole[0];}
    	
    	$body .=$this->getNovinkyPodlaRoku($rok);
		
    	$body.="	</div>
    	";
    	
    	$pom="";
    	for ($i=0;$i<30;$i++) $pom.="<br>";
    	if (strlen($body)<2000) $body .= $pom;
    	
    	$html .='
			<script src="/include/scrollable_div/urchin.js" type="text/javascript"></script>
			<script type="text/javascript" src="/include/scrollable_div/scrollable_div.js"></script>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div style="top: 0px;" id="scrolldiv_content">
						<div id="scrolerContent">
			    			'.$body.'
			    		</div>
					</div>
				</div>
				<div style="height: 400px;" id="scrolldiv_slider">
					<div id="scrolldiv_scrollUp"><img src="/pics/arrow_up.gif"></div>
					<div id="scrolldiv_scrollbar">
						<div id="scrolldiv_theScroll"><span></span></div>
					</div>
					<div id="scrolldiv_scrollDown"><img src="/pics/arrow_down.gif"></div>
				</div>
			</div>
		';
		
    	$html .='
			<script type="text/javascript">
				scrolldiv_setColor(\'#F6921D\');	// Setting color of the scrolling div
				setSliderBgColor(\'#E6E6E7\');	// Setting color of the scrolling div
				setContentBgColor(\'#FFFFFF\');	// Setting color of the scrolling div
				setScrollButtonSpeed(1);	// Setting speed of scrolling when someone clicks on the arrow or the slider
				setScrollTimer(5);	// speed of 1 and timer of 5 is the same as speed of 2 and timer on 10 - whats the difference? 1 and 5 will make the scroll move a little smoother.
				scrolldiv_setWidth(750);	// Setting total width of scrolling div
				scrolldiv_setHeight(400);	// Setting total height of scrolling div
				scrolldiv_initScroll();	// Initialize javascript functions
			</script>
			
			<script language="JavaScript" src="/include/scrollable_div/KonaLibInline.js"></script><script language="JavaScript" src="/include/scrollable_div/KonaLibBaseRM.js"></script><a href="#" target="_top" id="AdLinkLayerClick"></a>
			<script type="text/javascript" src="/include/scrollable_div/KonaLib_TreeCoreRM.js"></script>
			<script type="text/javascript" src="/include/scrollable_div/KonaGatewayCheck.js"></script>
		';
    	
    	
    	return $html;
    }
	
	///////////////////////////////////////////////////////////
    
	
	function getTHML(){
		$html = '';
		
		$this->page		= &$this->templateObject->pageObject;
		$this->auth 	= &$this->templateObject->pageObject->authentication; 		

		$pageData = $this->getPageData($this->page->pageId);
		
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
		
		//echo $this->page->pageId;
		
		switch ($pageData['type']){
			case 2:
			case 1:	// obycajna stranka
				if ($pageData['id']==3){
			    $html .= '<img src="/pics/stranka/3.jpg" alt=""/>'; 
				}
			    $html .= $this->ClasicPageContent($pageData['title'],$pageData['body']);	
				break;
				
			case 5: // cast form
				$html .='<h2>'.$pageData['title'].'</h2>';
				$html .= $this->getForm();
				break;
			case 6: // cast noviky
				$html .='<h1>Archív Noviniek</h1><br>';
				$html .= $this->getNovinky();
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