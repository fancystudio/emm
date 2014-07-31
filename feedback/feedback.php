<!DOCTYPE html>
<html>
	<head>
		<title>Hodnotenie webovej stránky emm</title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8"> 
			<script src="js/vendor/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://www.emm.sk/css/bootstrap.min.css">
	</head>
	<style>
	.alert{
		text-align: center
	}
	</style>
	<body>
	<div class="container" style="margin-top: 10%">
		<?php
		if(isset($_GET["feedback"]) && intval($_GET["feedback"]) >= 1 && intval($_GET["feedback"]) <=5){
			require_once('../config.php');
		    $ipaddress = '';
		    if ($_SERVER['HTTP_CLIENT_IP'])
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else if($_SERVER['HTTP_X_FORWARDED'])
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		    else if($_SERVER['HTTP_FORWARDED_FOR'])
		        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		    else if($_SERVER['HTTP_FORWARDED'])
		        $ipaddress = $_SERVER['HTTP_FORWARDED'];
		    else if($_SERVER['REMOTE_ADDR'])
		        $ipaddress = $_SERVER['REMOTE_ADDR'];
		    else
		        $ipaddress = 'UNKNOWN';
			$db = new PDO("mysql:host=".$config['db_hostname'].";port=".$config['db_port'].";unix_socket=/tmp/mariadb55.sock;dbname=".$config['db_name'], $config['db_username'], $config['db_password']);
			$db->exec("SET CHARACTER SET utf8");
			$ipVoted = false;
			$selectIp = "SELECT ip FROM cms_feedback";
			$resIp = $db->prepare($selectIp);
			$resIp->execute();
			while ($row = $resIp->fetch(PDO::FETCH_OBJ)){
				if($row->ip == $ipaddress){
					$ipVoted = true;		
				}
			}
			if(!$ipVoted){
				$insert = $db->prepare("INSERT INTO cms_feedback (ip, feedback, date) VALUES (?,?,?)");
				$insert->execute(array($ipaddress,$_GET["feedback"],date("Y-m-d H:i:s")));
				echo "<div class=\"alert alert-success\" role=\"alert\"><h2>Bolo úspešne odhlasované. Ďakujeme</h2></div>";
			}else{
				echo "<div class=\"alert alert-warning\" role=\"alert\"><h2>Môžete hlasovať iba raz</h2></div>";
			}
		}else{
			echo "<div class=\"alert alert-warning\" role=\"alert\"><h2>Bol zadaný nespravny parameter</h2></div>";
		}
		?>
		</div>
	</body>
</html>