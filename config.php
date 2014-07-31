<?php
# CMS Made Simple Configuration File
# Documentation: /doc/CMSMS_config_reference.pdf
#
$config['dbms'] = 'mysql';

//$config['db_hostname'] = 'mariadb55.websupport.sk';
//$config['db_username'] = 'devEmm';
//$config['db_password'] = 'devEmm12*';
//$config['db_name'] = 'devEmm';
//$config['db_port'] = 3310;

$config['db_hostname'] = 'mariadb55.websupport.sk';
$config['db_username'] = 'testEmm';
$config['db_password'] = 'testEmm12*';
$config['db_name'] = 'testEmm';
$config['db_port'] = 3310;

//$config['db_hostname'] = 'localhost';
//$config['db_username'] = 'root';
//$config['db_password'] = '';
//$config['db_name'] = 'devEmm';

$config['debug'] = false;
$config['uploads_path'] = dirname(__FILE__).'/uploads';
$config['db_prefix'] = 'cms_';
$config['timezone'] = 'Europe/Bratislava';
?>
