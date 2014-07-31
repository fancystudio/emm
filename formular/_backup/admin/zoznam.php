<?php

/*-------------------Filter----------------------------*/

$filter = strip_tags($_GET[filter]);

if(!$filter)

	$sql = "
		SELECT id,id_form,typ,objekt,inspector,prenos_na_pco,statna_policia,mestska_policia,sbs,sbs_tf
		FROM inspection_form ORDER BY id desc";
else {
	$insp = strip_tags($_POST[inspector]);
	$obj = strip_tags($_POST[object]);
	$typ = strip_tags($_POST[typ]);
	$pco = strip_tags($_POST[pco]);
	$sec = strip_tags($_POST[security]);
	$sni = strip_tags($_POST[snimac]);
	$zav = strip_tags($_POST[zavady]);
	
	//if(!($insp==0 and $obj==0 and ($typ=="typ" or empty($typ)) and $pco=="none" and $sec==0 and ($sni=="typ snímača" or empty($sni)))) $where="WHERE"; else $where="";
	
	if($insp==0) {
		$insp1 = "";
		$_SESSION["form"]["insp"] = "0";  
	}
	else{
		$insp1 = "inspector=$insp AND";
		$_SESSION["form"]["insp"] = $insp; 
	}
	if($obj==0){
		$obj1 = "";
		$_SESSION["form"]["obj"] = 0;
	}
	else {
		$obj1 = "objekt=$obj AND";
		$_SESSION["form"]["obj"] = $obj;
	}
	if($typ=="typ" or $typ=="" or $typ==null or empty($typ)){
		$typ1 = "";
		if(empty($typ)) $_SESSION["form"]["typ"] = "typ";
		elseif($typ=="typ") $_SESSION["form"]["typ"] = "typ";
	}
	else{ 
		$typ1 = "typ ilike '%$typ%' AND";
		$_SESSION["form"]["typ"] = $typ;
	}
	if($pco=="none") {
		$pco1 = "";
		$_SESSION["form"]["pco"] = "none";
	}
	else{
		if($pco=='t') {
			$pco1="prenos_na_pco='true' AND";
			$_SESSION["form"]["pco"] = 't';
		}
		else {
			$pco1="prenos_na_pco='false' AND";
			$_SESSION["form"]["pco"] = 'f';
		}
	}
	if($sec==0) {
		$sec1 = "";
		$_SESSION["form"]["sec"]=0;
	}
	else {
		if($sec == 1) {
			$sec1 = "mestska_policia='true' AND";
			$_SESSION["form"]["sec"]=1;	
		}
		elseif($sec == 2) {
			$sec1 = "statna_policia='true' AND";
			$_SESSION["form"]["sec"]=2;
		}
		else {
			$sec1 = "sbs_tf='true' AND";
			$_SESSION["form"]["sec"]=2;
		}
	}
	if($sni=="typ snímača" or $sni=="" or empty($typ)) {
		$sni1 = "";
		$_SESSION["form"]["sni"]="typ snímača";
	}
	else {
		$sni1 = "id_form IN (select key from inspection_form_snimace where typ ilike '%$sni%') AND";
		$_SESSION["form"]["sni"]="$sni";
	}
	
	if($zav=="t"){
		$zav = "zavady!='' AND";
		$_SESSION["form"]["zav"]="t";
	}
	else {
		$zav = "";
		$_SESSION["form"]["zav"]="f";
	}
	$sql = "
		SELECT id,id_form,typ,objekt,inspector,prenos_na_pco,statna_policia,mestska_policia,sbs,sbs_tf
		FROM inspection_form
		WHERE $insp1 $obj1 $typ1 $pco1 $sec1 $sni1 $zav 1=1
		ORDER BY id desc
	";
	
	//echo $sql;
}

	
if(($res = pg_query($sql))==false)
	die("database error 1");

if(isset($_SESSION["alert"])){
	echo '<div class="oznam"><div style="margin: 6px;">'.$_SESSION["alert"].'</div></div>';
}


//inspectors
$sql_ins = "SELECT * FROM inspector ORDER BY inspector";
$res_ins = pg_query($sql_ins);

$inspector = '<option value="0">inšpektor</option>';
while ($pole=pg_fetch_array($res_ins)) {
	if($pole["id"]==$_SESSION["form"]["insp"])
		$selected = "selected";
	else 
		$selected = "";
	$inspector .= '<option value="'.$pole["id"].'" '.$selected.'>'.$pole["inspector"].'</option>';
}

//objects
$sql_obj = "SELECT * FROM object ORDER BY mesto";
if(($res_obj = pg_query($sql_obj))==false)
	die("error document 2");

$object = '<option value="0">objekt</option>';
while ($pole=pg_fetch_array($res_obj)) {
	if($pole["id"]==$_SESSION["form"]["obj"])
		$selected = "selected";
	else 
		$selected = "";
	$object .= '<option value="'.$pole["id"].'" '.$selected.'>'.$pole["mesto"].', '.$pole["adresa_posty"].'</option>';
}





?>

<script type="text/javascript">

function zrusFilter(){
	document.getElementById("inspector").value=0;
	document.getElementById("object").value=0;
	document.getElementById("typ").value="typ";
	document.getElementById("inspector").value=0;
	document.getElementById("pco").value="none";
	document.getElementById("security").value=0;
	document.getElementById("zavady").checked=false;
	document.getElementById("snimac").value="typ snímača";
}

</script>

<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3; text-align: left">
	<form action="index.php?load=zoznam&amp;filter=t" method="post">
	<select name="inspector" id="inspector" style="width: 130px"><?php echo $inspector; ?></select>&nbsp;
	<select name="object" id="object" style="width: 280px"><?php echo $object; ?></select>&nbsp;
	<input type="text" name="typ" id="typ" size="15" value="<?php if(isset($_SESSION["form"]["typ"])) echo $_SESSION["form"]["typ"]; else echo "typ";  ?>" />&nbsp;
	<select name="pco" id="pco"><option value="none" <?php if($_SESSION["form"]["pco"]=="none") echo "selected"; ?>>prenos na PCO</option><option value="t" <?php if($_SESSION["form"]["pco"]=="t") echo "selected"; ?>>áno</option><option value="f" <?php if($_SESSION["form"]["pco"]=="f") echo "selected"; ?>>nie</option></select>&nbsp;
	<select name="security" id="security"><option value="0" <?php if($_SESSION["form"]["sec"]==0) echo "selected"; ?>>ochrana</option><option value="1" <?php if($_SESSION["form"]["sec"]==1) echo "selected"; ?>>mestská polícia</option><option value="2" <?php if($_SESSION["form"]["sec"]==2) echo "selected"; ?>>štátna polícia</option><option value="3">SBS</option></select>&nbsp;
	<input type="text" name="snimac" id="snimac" value="<?php if(isset($_SESSION["form"]["sni"])) echo $sni; else echo "typ snímača"; ?>" size="15" />&nbsp;
	<label><input type="checkbox" name="zavady" id="zavady" value="t" <?php if($_SESSION["form"]["zav"]=="t") echo "checked=\"checked\""; else echo ""; ?> /> závady</label>&nbsp;
	<input type="submit" value="filtrovať" />&nbsp;<input type="submit" value="zrušiť" onclick="zrusFilter();" />
	</form>
</div>
<table border="0" cellpadding="2" cellspacing="0" width="100%" align="center" class="zoznam_table">
<tbody>
	<tr>
		<th align="left">číslo</th>
		<!--<th>ID fomuláru</th>-->
		<th align="left">typ</th>
		<th align="left">objekt</th>
		<th align="left">inšpektor</th>
		<th>snímače</th>
		<th>sirény</th>
		<th>prenos na PCO</th>
		<th>ochrana</th>
		<th></th>
	</tr>
	<?php
	
	$count = 0;
	while($pole = pg_fetch_array($res)){
		
		$count++;
		
		//zistime objekt
		$sql1 = "SELECT mesto, adresa_posty FROM object WHERE id = ".$pole['objekt']."";
		if(($res1 = pg_query($sql1))==false)
			die("database error 2");
		$data = pg_fetch_array($res1);
		$object = $data[mesto].",&nbsp;".$data["adresa_posty"];
		
		//zistime inspectora
		$sql2 = "SELECT inspector FROM inspector WHERE id = ".$pole['inspector']."";
		if(($res2 = pg_query($sql2))==false)
			die("database error 3");
		$data = pg_fetch_array($res2);
		$inspector = $data[inspector];
		
		//pocet snimacov
		$sql3 = "SELECT count(id) as sn_pocet FROM inspection_form_snimace WHERE key=".$pole['id_form']." AND status=1";		
		if(($res3 = pg_query($sql3))==false)
			die("database error 4");
		$data = pg_fetch_array($res3);
		$snimace = $data[sn_pocet];
		
		//pocet siren
		$sql4 = "SELECT count(id) as si_pocet FROM inspection_form_sireny WHERE key=".$pole['id_form']." AND status=1";
		if(($res4 = pg_query($sql4))==false)
			die("database error 5");
		$data = pg_fetch_array($res4);
		$sireny = $data[si_pocet];
		
		if($pole["prenos_na_pco"]==t)
			$prenos = "áno";
		else 
			$prenos = "nie";
		
		if($pole["statna_policia"]==t)
			$ochrana = "štátna polícia";
		elseif($pole["mestska_policia"]==t)
			$ochrana = "mestská polícia";
		elseif($pole["sbs_tf"]==t)
			$ochrana = "SBS"." ".$pole["sbs"];
		else 
			$ochrana = "----";
		
		//farba riadku
		if(fmod($count,2)==0)
			$trcolor = "#F5F5F5";
		else 
			$trcolor = "#FFFFFF";
			
		echo "
		<tr bgcolor=\"$trcolor\">
			<td><b>".$pole["id"]."</b></td>
			<!--<td>".$pole["id_form"]."</td>-->
			<td>".$pole["typ"]."</td>
			<td>".$object."</td>
			<td>".$inspector."</td>
			<td><center>$snimace</center></td>
			<td><center>$sireny</center></td>
			<td><center>".$prenos."</center></td>
			<td>".$ochrana."</td>
			<td align=\"right\"><a title=\"edit\" href=\"index.php?load=formular.php&amp;akcia=edit&amp;id=$pole[id]\"><img src=\"../pics/system/table_edit.png\" alt=\"edit\" /></a><a title=\"delete\" href=\"index.php?akcia=delete&amp;id=$pole[id]&amp;key=$pole[id_form]\" onclick=\"return confirm('Naozaj chcete vymazať formulár s id $pole[id]?');\"><img src=\"../pics/system/table_delete.png\" alt=\"delete\" /></a><a href=\"index.php?load=formular.php&amp;akcia=print&amp;id=$pole[id]&amp;key=$pole[id_form]\"><img src=\"../pics/system/table_print.png\" alt=\"tlačiť\" border=\"0\" title=\"print\" /></a></td>
		</tr>
		";
	}
	
	?>

</tbody>
</table>


