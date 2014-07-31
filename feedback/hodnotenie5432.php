<!DOCTYPE html>
<html>
	<head>
		<title>Hodnotenia webovej stránky emm</title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<script src="js/vendor/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://www.emm.sk/css/bootstrap.min.css">


	</head>
	<body>
		<?php
		require_once('../config.php');
		$db = new PDO("mysql:host=".$config['db_hostname'].";port=".$config['db_port'].";unix_socket=/tmp/mariadb55.sock;dbname=".$config['db_name'], $config['db_username'], $config['db_password']);
		$db->exec("SET CHARACTER SET utf8");
		$selectFeedback = "SELECT * FROM cms_feedback";
		$resFeedback = $db->prepare($selectFeedback);
		$resFeedback->execute();
		$feedbacks = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0);
		
		while ($row = $resFeedback->fetch(PDO::FETCH_OBJ)){
			$feedbacks[$row->feedback-1]++;
		}
		
		?>
		
		<div class="container">
		
		<table class="table">
			<thead>
			<tr>
				<td><h1>Hodnotenie</h1></td>
				<td><h1>Počet hlasov</h1></td>	
			</tr>
			</thead>
			<tbody>
		<?php 
		$starsCount = 5;
		foreach($feedbacks as $key => $value){
			?>
			<tr>
				<td>
				<?php 
				for($i=0;$i<$starsCount;$i++){
					?>
					<span class="glyphicon glyphicon-star"></span>
					<?php 
				}
				?>
				</td>
				<td><?php echo $value;?></td>
			</tr>
			<?php 
			$starsCount--;
		}
		?>
		</tbody>
		</table>
		</div>
	</body>
</html>