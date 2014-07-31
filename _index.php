<?php
if ($_GET['path']=='flexlogin/download') {
  header("Location: http://www.emm.sk/sk/produkty-a-sluzby/sw-aplikacie/flexlogin/prevzatie/");
}
 
define("DOCROOT",realpath(dirname(__FILE__)));

session_set_cookie_params(0);	// nekonecno
session_cache_limiter('nocache');
session_start();

include_once(DOCROOT.'/include/config.inc.php');
include_once(DOCROOT.'/include/others.inc.php');
include_once(DOCROOT.'/include/page.class.php');
include_once(DOCROOT.'/include/seo.inc.php');

$setSEO = new seo();
$setSEO->setSEOUrl();

$page = new Page();
echo $page->getHTML();		

?>
