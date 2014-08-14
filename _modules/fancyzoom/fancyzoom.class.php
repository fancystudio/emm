<?php
include_once(DOCROOT.'/include/basic.class.php');

class fancyzoom extends basic {
	var $templateObject;	/* @var $templateObject template*/ // ukazovatel na objekt sablony
	var $sqlDB;				/* @var $sqlDB sql */	// sql connection object
	var $auth;				/* @var $auth auth */	// authentification object
	var $page;				/* @var $page Page */	// page object
    var $pageId;					// id otvorenej stranky        

	function fancyzoom(){
	}
	function getTHML(){
		$html = "
			<script type=\"text/javascript\">
			$(function(){
				$('a.graybox').fancyzoom({Speed:0,showoverlay:true,overlay:4/10});
			});
		</script>
		";
			
			
        return $html;
	}
}
?>
