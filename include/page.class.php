<?php
// errorCode <00201 - 00299>
include_once(DOCROOT.'/include/basic.class.php');

include_once(DOCROOT.'/include/sql.class.php');
include_once(DOCROOT.'/include/auth.class.php');
include_once(DOCROOT.'/include/template.class.php');

class Page extends basic {
	var $template;					/* @var $template template*/ 	// objekt pre pracu so sablonou
	var $authentication;			/* @var $authentication auth*/ 	// auth class
	var $sqlDB;						/* @var $sql sql*/ 				// sql class
	var $messageCode;				// kod spravy
	var $messageText;				// text spravy
	var $startTime;					// premenna na vypocet casu vykonania skriptu
	var $endTime;					// premenna na vypocet casu vykonania skriptu
	var $activeModul;				// vybrany/aktivny modul 
	var $withMenu;					// ci sa ma zobrazit aj menu
	var $openedProgramId;			// ID otvoreneho programu
	var $pageId;					// id otvorenej stranky
	var $lang;						// kod jazyka
	
	function Page($_template=null, $_theme=null){
		global $modules, $languages, $langCode2lang;
		
		$this->openedProgramId = PROGRAMID;
		
		$this->startTime = microtime();
		$this->authentication = new auth();
		
		$this->sqlDB = new sql();
		$this->sqlDB->sql_connect();
        
        $pathNotFound=strip_tags($_GET['pathNotFound']);
		                                     
		// vybranie aktualneho modulu na pracu
		$tmpMod = strip_tags($_GET['module']);
		if(isset($tmpMod) AND $tmpMod!=''){
			// ak je vybrany bodul a existuje v zozname modulov
			// *** dorobit kontrolu prisupu k modulu
			$this->activeModul = $tmpMod;
		}else{
			$this->activeModul = 'pageContent';
		}
		
		// zistenie ci sa ma zobrazit aj menu
		$tmpNoMenu = strip_tags($_GET['noMenu']);
		if(isset($tmpNoMenu) AND $tmpNoMenu==1){
			$this->withMenu = false;
		}else{
			$this->withMenu = true;
		}

		// zistim id stranky
		$tmpPageId = strip_tags($_GET['pageId']);
		$this->pageId = intval($tmpPageId);
		if ($this->pageId != 48) {
			$this->pageId = $this->getNormalizedPageId($this->pageId);
		}
		// urcim jazyk
		$mainPageId = $this->getMainPageId($this->pageId);
		
		if (array_key_exists($mainPageId, $languages)) {
			$this->lang = $languages[$mainPageId];
		}else{
			echo 'Error: unknow page language';
			exit();
		}

		putenv("LANG=".$this->lang );
		//setlocale(LC_ALL, $this->lang.'.ISO8859-2');
		setlocale(LC_ALL, $this->lang );
		//bindtextdomain("messages", DOCROOT."/locale");
		//textdomain("messages");

		$this->template = new template($_template);
        $this->template->_modules['topMenu'] = 'topMenu';
        $this->template->_modules['leftMenu'] = 'leftMenu';
        $this->template->_modules['bottomAktualne'] = 'bottomAktualne';
        $this->template->_modules['pageContent'] = 'pageContent';
        $this->template->_modules['fancyzoom'] = 'fancyzoom';
        $this->template->_modules['googleAnalytics'] = 'googleAnalytics';
		//$this->template->_modules['M2']	= $this->activeModul;
		$this->template->pageObject = $this;
			
		$pageData = $this->getPageData($this->pageId);
		
		// nastavenie templajtov
		if ($pathNotFound==1) {
			$this->template->setTemplate('pagenotfound');
	    }else {
	    	if ($pageData['type'] !=5 OR $this->pageId==249){
				if ($this->lang=='en_US')  {
          $this->template->setTemplate('main-en');
				}
				else {
          $this->template->setTemplate('main');
				}
	    	}
	    	else {
          if($this->lang=='en_US') $this->template->setTemplate('form-en');
          $this->template->setTemplate('form');   
	    	}
		}
		
		$pagesPath = $this->getPagesPath($this->pageId);

    $titlePath = array();
    while(list(, $pId)=each($pagesPath)){
			//$pData = $this->getPageData($pId);
			$sql = "
				SELECT title
				FROM page
				WHERE status = 1 AND id = $pId;
			";
			$res = $this->sqlDB->sql_query($sql);
			if($res==false) return false;
			if($this->sqlDB->sql_num_rows($res)!=1) return false;

			$data = $this->sqlDB->sql_fetch_row($res);

			$titlePath[] = $data['title'];
		}

   	$this->template->setVar('titlePath', strip_tags(implode(' - ', array_reverse($titlePath))));

    $res = $this->sqlDB->sql_query("SELECT description_short FROM page_properties WHERE property_name='body' AND id_page=".$this->pageId);
    if($res && $this->sqlDB->sql_num_rows($res)==1)
    {
      $record = $this->sqlDB->sql_fetch_row($res);

      $meta_description = strip_tags($record['description_short']);
    }
    else $meta_description = 'EMM';

    $this->template->setVar('meta_description', htmlspecialchars(str_replace("\n", '', mb_substr($meta_description, 0, 250, 'UTF-8'))));

		// nastavenia podla jazykov
		$this->template->setVar('menu_config',$langCode2lang[$this->lang]);
		switch ($langCode2lang[$this->lang]){
			default:
			case 'sk':
				$this->template->setVar('footer_left','CREDITE');
				$this->template->setVar('footer_left2','CREDITE');
				$this->template->setVar('home','<a href="/index.php?pageId=66">úvod</a>');
				$this->template->setVar('homeLogoLink','/index.php?pageId=66');
				$this->template->setVar('site_map','<a href="index.php?pageId=16">mapa stránok</a>');
				$this->template->setVar('top_slogan','');
				$this->template->setVar('flash_dir','sk');
				$this->template->setVar('searchEngine_describtion','EMM');
				$this->template->setVar('searchEngine_keywords','');
				break;
			case 'en':
				$this->template->setVar('footer_left','CREDITE');
				$this->template->setVar('footer_left2','CREDITE, s.r.o.');
				$this->template->setVar('home','<a href="/index.php?pageId=67">home</a>');
				$this->template->setVar('homeLogoLink','/index.php?pageId=67');
				$this->template->setVar('site_map','<a href="index.php?pageId=85">site map</a>');
				$this->template->setVar('top_slogan','');
				$this->template->setVar('flash_dir','en');
				$this->template->setVar('searchEngine_describtion','EMM');
				$this->template->setVar('searchEngine_keywords','');
				break;
		}
		
		
		$this->htmlOutput = '';
		$this->endTime = microtime();
	}
	
	function getHTML(){
		$this->endTime = microtime();

		return $this->template->getHTML();
	}
	
	function getNormalizedPageId($pageId){
		global $languages;
		// return first sub page id if page has empry body
		if (!isset($pageId) OR !is_numeric($pageId) OR $pageId=='') {
			list($defPageId,) = each($languages);
			return $defPageId;
		}

		$retVal = $pageId;
		if (array_key_exists($pageId, $languages)) {
			return $pageId;
		}

		// zistim telo stranky
		$data = $this->getPageData($pageId);
		if ($data==false) {
			return false;
		}

		if ($data['type']==3) {
			return $pageId;
		}

		// overym telo stranky
		if(
			trim($data['body'])=='' OR 
			trim(strtolower($data['body']))=='<p>&nbsp;</p>' OR 
			strtolower($data['body'])==trim('&nbsp;')
		){
			// ak je stranka prazdna skusim najst prvu podstranku
			$sql = "
				SELECT id_sub_page
				FROM page_connection
				WHERE 
					id_main_page = $pageId AND
					status = 1
				ORDER BY page_order
				LIMIT 1;
			";
			$res = $this->sqlDB->sql_query($sql);
			if($res==false)
				return false;
			
			if($this->sqlDB->sql_num_rows($res)==1){
				$data = $this->sqlDB->sql_fetch_row($res);
				if ($retVal!=202) {
				$retVal = $this->getNormalizedPageId(intval($data['id_sub_page']));
				}
			}
		}
		
		return $retVal;
	}

	function getGenerateMTime(){
		$s = explode(" ",$this->startTime);
		$e = explode(" ",$this->endTime);

		return ($e[1]+$e[0])-($s[1]+$s[0]);
	}
	
	function getURL($param=null, $fragment=null){
		$url = 'index.php';
		
		$pArray = array();
		if($this->activeModul!='')
			$pArray['module'] = $this->activeModul;
		
		if ($this->withMenu==false)
			$pArray['noMenu'] = 1;

		if (isset($this->pageId) AND $this->pageId!='')
			$pArray['pageId'] = $this->pageId;
			
		if(isset($param) AND is_array($param)){
			while(list($key, $val) = each($param)){
				$pArray[$key] = $val;
			}
		}
		
		
		reset($pArray);
		while(list($name,$value) = each($pArray)){
			$parameters .= ($parameters=='')?'?':'&amp;';
			$parameters .= $name.'='.$value;
		}
		
		if ($fragment!='') {
			$fragment = '#'.$fragment;
		}
		
		return $url.$parameters.$fragment;
	}
	
	function getWinOpen($param=null,$withOnClick=true){
		$uniqname = uniqid(rand());

		$param['noMenu'] = 1;
		
		$winopenStart = "onclick=\"";
		$winopenMiddle = "window.open('".$this->getURL($param)."','".$uniqname."','resizable=yes, scrollbars=yes, status=yes, titlebar=no, toolbar=no, width=500, height=500'); return(false);";
		$winopenEnd = "\"";
		
		if ($withOnClick) {
			return $winopenStart.$winopenMiddle.$winopenEnd;
		}else{
			return $winopenMiddle;
		}
	}

	function getPageData($pageId=null){
		if($pageId===null)
			return false;

		$sql = "
			SELECT id, title, type, status, date(created) as created
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

	function getPagesPath($pageId){
		if (!isset($pageId) OR !is_numeric($pageId) OR $pageId==='') {
			return false;
		}

		$pagesPath = array();
		$pagesPath[] = $pageId;
		
		$mainPageId = $this->getMainPageId($pageId, $this->getMainLangPageId($this->lang));

		while(!in_array($mainPageId, $pagesPath)){
			$pageId = intval($this->getParentPageId($pageId));
			if ($pageId===0) {
				break;
			}
			$pagesPath[] = $pageId;
		}
		
		return array_reverse($pagesPath);
	}

	function getParentPageId($pageId){
		if (!isset($pageId) OR !is_numeric($pageId) OR $pageId=='') {
			return false;
		}
		
		$sql = "
			SELECT id_main_page
			FROM page_connection 
			WHERE id_sub_page = $pageId;
		";
		
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false OR $this->sqlDB->sql_num_rows($res)!=1){
			return false;
		}
		
		$tmpData = $this->sqlDB->sql_fetch_row($res);
		
		return $tmpData['id_main_page'];
	}

	function getSubPagesList($fromPageId=0){

		$mainPageId = $this->getMainPageId($this->pageId,1);
		if ($fromPageId == 48 || $fromPageId == 202) {
			$firstOrder = " a.created desc, ";
		}

		if ($this->pageId==263 OR $this->pageid=265) {
			$limit = "limit 14";
		}
		elseif ($this->pageId==48) {
			$limit = "limit 12";
		}
		
		if ($mainPageId==48 || $fromPageId == 202) {
			$limit = "limit 12";
		}
	
		$sql = "
			SELECT a.id_sub_page, a.link_text, count(b.id_sub_page) AS sub_count
			FROM page_connection AS a
			LEFT JOIN page_connection AS b ON a.id_sub_page=b.id_main_page AND b.status = 1
			WHERE 
				a.id_main_page = $fromPageId AND
				a.status = 1
			GROUP BY a.id_sub_page, a.link_text, a.page_order, a.created
			ORDER BY $firstOrder a.page_order
			$limit
			;
		";	
		$res = $this->sqlDB->sql_query($sql);
		if ($res==false) {
			return false;
		}
		
		$subPagesList = null;

		$i = 0;
		while(($tmpData=$this->sqlDB->sql_fetch_row($res))!=false){
			$subPagesList[$i]['id'] 		= intval($tmpData['id_sub_page']);
			$subPagesList[$i]['link']		= $tmpData['link_text'];
			$subPagesList[$i]['sub_count']	= intval($tmpData['sub_count']);
			$i++;
		}

		return $subPagesList;
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

	function getMainLangPageId($langCode=null){
		global $languages;
		
		if ($langCode==null) {
			return false;
		}
		
		$mainLangPageId = null;
		
		reset($languages);
		while(list($tmpPageid, $tmpLangCode)=each($languages)){
			if ($tmpLangCode == $langCode) {
				$mainLangPageId = $tmpPageid;
				break;
			}
		}
		
		if($mainLangPageId==null){
			return false;
		}else{
			return $mainLangPageId;
		}
	}
    
    function getSEOURL($id=null){
        $this->sqlDB = new sql(); 
        $this->sqlDB->sql_connect();
        $url = '/index.php';
		
        $sql = "
            SELECT path
			FROM page_path
			WHERE page_id = '$id';
			";           
             
        $res = $this->sqlDB->sql_query($sql);
		if($res==false){
			return false;
		}

		if($this->sqlDB->sql_num_rows($res)>0){
           $data = $this->sqlDB->sql_fetch_row($res);   
		   $finalUrl = "/".$data[0];           
        } else {
           $parameters="?pageId=$id";
           $finalUrl=$url.$parameters;
        }
        
        //return '/index.php?pageId='.$id;
		return $finalUrl;
	}
    
    
}
?>
