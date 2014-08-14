<?php
include_once(DOCROOT.'/include/basic.class.php');

class bottomAktualne extends basic {
	var $templateObject;	/* @var $templateObject template*/ // ukazovatel na objekt sablony
	var $sqlDB;				/* @var $sqlDB sql */	// sql connection object
	var $auth;				/* @var $auth auth */	// authentification object
	var $page;				/* @var $page Page */	// page object
    var $pageId;					// id otvorenej stranky        

	function bottomAktualne(){
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
	
	function getSubMenuNode($fromPageId, $pagesPath){
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
		if (count($subPageList)>0) {
			$i = 0;
			while(list(,$val) = each($subPageList)){
				$i++;
				if ($this->page->pageId==$val['id']) {
					 $html .= '<span class="orange">>></span>&nbsp;<a href="'.$this->page->getSEOURL($val['id']).'"><span class="svietlink">'.$val['link'].'</span></a>'."\n";
				}else{
           			$html .= '<span class="orange">>></span>&nbsp;<a href="'.$this->page->getSEOURL($val['id']).'">'.$val['link'].'</a>'."\n";
				}	
				if ($i == 5)break;		
			}			
		}
		
		return $html;
	}
	
	function getMenu($pagesPath){
		if (!isset($pagesPath) OR !is_array($pagesPath) OR count($pagesPath)<=0) {
			return false;
		}
		
		$startPageId = $pagesPath[0];
		$html = $this->getSubMenuNode($startPageId, $pagesPath);

		return $html;		
	}
	
	function getTHML(){
		global $menuItem;
		$html = '';
		
		$this->page 	= &$this->templateObject->pageObject;
		$this->auth 	= &$this->templateObject->pageObject->authentication;
		
		$pagesPath = $this->page->getPagesPath($this->page->pageId);
		//print_r($pagesPath);
		//$pageData = $this->getPageData($pagesPath[0]);

		$pagesPath[0] = 48;
		//echo $this->page->pageId;
		// vrati nadpis
		$html .= "<div class='bottomAktualne'>";	
		$html .= "<span class=\"orange\" style='font-size:11px'>Novinky</span><br>";	
	
			$html .= $this->getMenu($pagesPath);	
		$html .= "</div>";	
		
		
        return $html;
	}
}
?>
