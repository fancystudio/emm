<?php

session_start();

//pg_connect("dbname=emmtest") or die ("nenadviazalo sa spojenie so serverom<br />");
pg_connect("user=emm dbname=emm password=emmsk") or die ("nenadviazalo sa spojenie so serverom<br />");

//deletuje formulare
if(strip_tags($_GET["akcia"])=="delete"){
	$id = strip_tags($_GET[id]);
	$key = strip_tags($_GET[key]);
	$sql = "
		BEGIN TRANSACTION;
		DELETE FROM inspection_form WHERE id=$id;
		DELETE FROM inspection_form_snimace WHERE key=$key;
		DELETE FROM inspection_form_sireny WHERE key=$key;
		COMMIT TRANSACTION";
	
	if(($res = pg_query($sql)) == false){
		$_SESSION["alert"] = "nepodarilo sa vymazať formulár z databázy";
	}
	else 
		$_SESSION["alert"] = "formulár bol úspešne vymazaný z databázy";
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="netropolis s.r.o." />
		
		<link rel="stylesheet" type="text/css" href="../styles/form_css.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../styles/form_css_print.css" media="print" />
		<script type="text/javascript" src="../include/calendar/jscalendar-setup.php"></script>
		<script type="text/javascript" src="../include/calendar/calendar.js"></script>
		<script type="text/javascript" src="../include/calendar/jscalendar-setup.php"></script>
		<link rel="stylesheet" type="text/css" media="all" href="../include/calendar/calendar-blue.css" title="winter" />
		<title>EMM, spol. s r.o. </title>    
 		
</head>
<body>

<center>


<div class="floater">
<div id="content" >

	

	<!--
		<div id="drop-down-menu">
			<div class="menu_form">
				<a href="index.php">zoznam záznamov&nbsp;</a>
				<a href="index.php?load=formular.php">&nbsp;pridať záznam</a>
				<div class="clear"></div>
			</div>
		</div>
	-->
		
		<div id="main" style="margin-top: 25px">
			<?php
			
			$load = $_GET["load"];
			switch($load){
				
				case "formular.php": include("../formular.php"); break;
				default: include("zoznam.php");
			}
			
			?>
		</div>
	</div>
	<br />
	
	
	

	</div>

</div>


<div class="clear"></div>
<div id="ciara_dole">
	</div>

</center>
</body>
</html>
<?php

unset($_SESSION["alert"]);

?>
