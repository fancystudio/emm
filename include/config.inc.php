<?php
define("DEBUG",0); // ak 1 su zapnute vypisy, inak nie

define("PROGRAMID", 19);
define("PRODPERPAGE", 10);
define("ORDERPERPAGE", 15);

define("DEFAULTTHEMEDIR",'themes');				// default adresar pre temy
define("DEFAULTTEMPLATEDIR",'templates');			// default adresar pre sablony

define("DEFAULTTHEMENAME",'default');			// nazov defaultnej temy
define("DEFAULTTEMPLATENAME", 'main'); 			// nazov defaultnej sablony

define("MODULESDIR",'modules');

define("DRAZBAIMGDIRSMALL",'pics/upload/drazba/small/');
define("DRAZBAIMGDIRBIG",'pics/upload/drazba/big/'); 
define("DRAZBAIMGDIRDOC",'pics/upload/drazba/doc/'); 
define("MAXDRAZBAFOTOS",10); 

define("REALITAIMGDIRSMALL",'pics/upload/realita/small/');
define("REALITAIMGDIRBIG",'pics/upload/realita/big/'); 
define("MAXREALITAFOTOS",10); 



/* menu polozky */
$menuItem[0]['name']	= '�vod';
$menuItem[0]['id'] 		= '7';

$menuItem[1]['name']	= '�o je Icopal Bonus?';
$menuItem[1]['id'] 		= '6';

$menuItem[2]['name']	= 'D�veru a spolupr�cu odme�ujeme!';
$menuItem[2]['id'] 		= '5';

$menuItem[3]['name']	= 'Registra�n� formul�r';
$menuItem[3]['id'] 		= '2';

$menuItem[4]['name']	= 'Pravidl� programu';
$menuItem[4]['id'] 		= '1';


$bonusMenuItem[0]['name']	= '�vod';
$bonusMenuItem[0]['id']		= '';

$bonusMenuItem[1]['name']	= 'Produkty';
$bonusMenuItem[1]['id']		= '4';

$bonusMenuItem[2]['name']	= 'Odmeny';
$bonusMenuItem[2]['id']		= '3';

$bonusMenuItem[3]['name']	= 'Moje objedn�vky';
$bonusMenuItem[3]['id']		= '16';

$bonusMenuItem[4]['name']	= 'M�j profil';
$bonusMenuItem[4]['id']		= '17';


$languages[1] = 'sk_SK'; // SK
$languages[2] = 'en_US'; // EN

$langCode2lang['sk_SK'] = 'sk';//'menu_settings_sk.js';
$langCode2lang['en_US'] = 'en';//'menu_settings_en.js';

$welcomePages['sk_SK'] = 1;
$welcomePages['en_US'] = 2;

$presentPages['sk_SK'] = 1;
$presentPages['en_US'] = 87;
$presentPages['ru_RU'] = 196;
$presentPages['it_IT'] = 265;

$newPages['sk_SK'] = 291;
$newPages['en_US'] = 292;
$newPages['ru_RU'] = 294;
$newPages['it_IT'] = 293;

?>
