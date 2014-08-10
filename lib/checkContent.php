<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);
	require_once('../config.php');
	require_once('HelperClass.php');
	$help = new Helper;
	$dsn = "mysql:host=".$config['db_hostname'].";port=".$config['db_port'].";unix_socket=/tmp/mariadb55.sock;dbname=".$config['db_name'];
	try{
	  $db = new PDO($dsn, $config['db_username'], $config['db_password']);
	  $db->exec("SET CHARACTER SET utf8");
	} catch (Exception $e) {
		echo "Failed: " . $e->getMessage();
	    $db->rollBack();
	}
	$response_array['status'] = 'success';
	$response_array['contentIsExist'] = $help->checkContent($db, $_POST["contentType"], $_POST["contentId"]);;
	header('Content-type: application/json');
	echo json_encode($response_array);
?>
