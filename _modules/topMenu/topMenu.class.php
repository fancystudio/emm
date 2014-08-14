<?php
include_once(DOCROOT.'/include/basic.class.php');
 
class topMenu extends basic {
	var $templateObject;	/* @var $templateObject template*/ // ukazovatel na objekt sablony
	var $sqlDB;				/* @var $sqlDB sql */	// sql connection object
	var $auth;				/* @var $auth auth */	// authentification object
	var $page;				/* @var $page Page */	// page object
    
    
	function topMenu(){
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
	
	function getULLImenu($pageId=0, $level)
  {
		if(!isset($pageId) OR !is_numeric($pageId) OR $pageId==='' OR $pageId==21 OR $pageId==289 OR $pageId==290 OR $pageId==157) return false;
		
		$sql = "
			SELECT a.id_sub_page, a.link_text, count(b.id_sub_page) AS sub_count
			FROM page_connection AS a
			LEFT JOIN page_connection AS b ON a.id_sub_page=b.id_main_page
			WHERE
				a.id_main_page = $pageId AND
				a.status = 1 AND
        a.id_sub_page NOT IN(305) 
			GROUP BY a.id_sub_page, a.link_text, a.page_order
			ORDER BY a.page_order;
		";
		$res = $this->sqlDB->sql_query($sql);

    if($res==false) return false;
		if($this->sqlDB->sql_num_rows($res)==0) return '';

    $n = 1;
    $submenu_class = str_repeat('sub_', $level).'menu_';

		$html .= '<ul>';
		while(($tmpData = $this->sqlDB->sql_fetch_row($res))!=false)
    {
			$html .= '<li class="'.$submenu_class.$n.'">';

			if ($this->page->getSEOURL($tmpData['id_sub_page'])=='/sk/servis-a-podpora/helpdesk/' OR $this->page->getSEOURL($tmpData['id_sub_page'])=='/en/servicing-and-support/helpdesk/')
      {
				//$html .= '<a href="https://helpdesk.emm.sk" target="_top">'.strip_tags($tmpData['link_text']).'</a>';
			}
			else
      {
				$html .= '<a href="'.$this->page->getSEOURL($tmpData['id_sub_page']).'">'.strip_tags($tmpData['link_text']).'</a>';
			}

			if($tmpData['sub_count']>0) $html .= $this->getULLImenu($tmpData['id_sub_page'], $level+1);
			$html .= "</li>\n";

      $n++;
		}

		if ($pageId==3) $html .='<li class="'.$submenu_class.$n.'"><a href="'.$this->page->getSEOURL(48).'">Novinky</a></li>';

		if ($pageId==150) $html .='<li class="'.$submenu_class.$n.'"><a href="'.$this->page->getSEOURL(202).'">News</a></li>';

		if ($pageId==21) $html .='<li class="'.$submenu_class.$n.'"><a href="'.$this->page->getSEOURL(21).'">Partnerstvá</a></li>';

		if ($pageId==157) $html .='<li class="'.$submenu_class.$n.'"><a href="'.$this->page->getSEOURL(157).'">Partnerships</a></li>';

		$html .= "</ul>\n";

		return $html;
	}
	
	function getSubMainPageIDs($fromPageId, $pagesPath){
		if (!isset($pagesPath) OR !is_array($pagesPath) OR count($pagesPath)<=0) {
			return false;
		}
		
		if (!isset($fromPageId) OR !is_numeric($fromPageId) OR $fromPageId==='') {
			return false;
		}
		
		$pageData = $this->page->getPageData($fromPageId);
		if ($pageData['type']==3) {
			return false;
		}
		$subPageList = $this->page->getSubPagesList($fromPageId);
		$i=0;	
		
		if (count($subPageList)>0) {
			while(list(,$val) = each($subPageList))
      {
				$poleid[$i]= $val['id'];
				$i++;
			}			
		}
		
		return $poleid;
	}

	function getTHML(){
		global $menuItem, $langCode2lang, $welcomePages, $pageId;
		$html = '';
	  
		$this->page		= &$this->templateObject->pageObject;
		$this->auth 	= &$this->templateObject->pageObject->authentication; 		
    
	    // na zistenie jazyka
	    $mainPage = $this->page->getMainPageId($this->page->pageId);

	    $pagesPath = $this->page->getPagesPath($this->page->pageId);
		
	    //1 alebo 2 podla jazyka , vrati id stranok ktore su hlavne
	    switch ($this->page->lang){
		case 'sk_SK':
	    		$pole = $this->getSubMainPageIDs(1,$pagesPath);
			break;
		case 'en_US':
	    		$pole = $this->getSubMainPageIDs(2,$pagesPath);	
		    break;
		default:
	    		$pole = $this->getSubMainPageIDs(1,$pagesPath);	
		    break;
		}
		
	    //$pole = $this->getSubMainPageIDs(1,$pagesPath);	
	   
	    // vypise menu

	  $html .= '<ul>';

    $n = 1;
    for($i = 0; $i<=count($pole)-1; $i++)
    {
      $pageData = $this->page->getPageData($pole[$i]);
    	if($pageData['id'] !=262 && $pageData['id'] !=263 && $pageData['title'] !="News" && $pageData['title'] !="Personal data protection principles" && $pageData['title'] !="Terms of usage" && $pageData['title'] !="Novinky" && $pageData['title'] != "Zásady ochrany osobných údajov" && $pageData['title'] != "Riadenie kvality" && $pageData['title'] != "Podmienky používania")
      {
        $html .= '<li class="menu_'.$n.'"><a href="'.$this->page->getSEOURL($pageData['id']).'">'.$pageData['title'].'</a><ul class="shadow"><li>'.$this->getULLImenu($pole[$i], 1).'</li></ul></li>';

        $n++;
      }
    }

    $html .= '</ul>';

    return $html;
	}
}
    
    
?>
