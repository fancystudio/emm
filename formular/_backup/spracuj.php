<?php

session_start();

//pg_connect("dbname=emmtest") or die ("nenadviazalo sa spojenie so serverom<br />");
//pg_query ("SET NAMES 'utf8'");
pg_connect("user=emm dbname=emm password=emmsk") or die ("nenadviazalo sa spojenie so serverom<br />");

//bolo tam AND staus=0
function show_items($key,$table){
	
	$sql = "SELECT * FROM inspection_form_$table WHERE key=$key AND (status=1 OR status=0) ORDER BY id";

	//echo $sql;
	
	if(($res = pg_query($sql)) == false)
		die("nepodarilo sa zobrziť výsledky");
		
	$html = '<table border="0" cellpadding="0" cellspacing="0" width="100%" >';
	
	while($pole = pg_fetch_row($res)){
		if($pole[7]=="t"){
			$checked_func = 'checked="checked"';
			$checked_func_val = '&nbsp;funguje';
		}
		else{
			$checked_func = "";
			$checked_func_val = '&nbsp;nefunguje';
		}
		if($pole[8]=="t"){
			$checked_poloha = 'checked="checked"';
			$checked_poloha_val = '&nbsp;vyhovuje';
		}
		else{
			$checked_poloha = "";
			$checked_poloha_val = '&nbsp;nevyhovuje';
		}
		if($pole[6]=="t"){
			$checked_zaloha = 'checked="checked"';
			$checked_zaloha_val = '&nbsp;zálohovaná';
		}
		else{
			$checked_zaloha = '""';
			$checked_zaloha_val = '&nbsp;nezálohovaná';
		}
		
		if($table == "snimace")	
			$html .= '
			<tr>
				<td>
					<div style="float: left">
						 <input type="hidden" name="id_snimac" value="'.$pole[0].'" id="id_snimac_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[2].'" size="3" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[3].'" size="5" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[4].'" size="15" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[5].'" size="15" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[6].'" size="10" class="input_t" />
					 </div>
					 <div style="float: left; width: 170px; text-align: center"><input type="checkbox" '.$checked_func.' />'.$checked_func_val.'</div>
					 <div style="float: left; width: 170px; text-align: center"><input type="checkbox" '.$checked_poloha.' />'.$checked_poloha_val.'</div>
				 	 <div style="float: right;"><input type="button" value="zruš" size="20" onclick="prevedQuery_snimac_delete(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" /></div>
				 	 <div style="clear: both"></div>
				 <td>
			</tr>
			';
		if($table == "sireny")
			$html .= '
			<tr>
				<td>
					 <div style="float: left">
						 <input type="hidden" name="id_sirena" value="'.$pole[0].'" id="id_sirena_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[2].'" size="3" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[3].'" size="15" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[4].'" size="15" class="input_t" />&nbsp;
						 <input type="text" value="'.$pole[5].'" size="10" class="input_t" />
					 </div>
					 <div style="float: left; width: 210px; text-align: center"><input type="checkbox" '.$checked_zaloha.' />'.$checked_zaloha_val.'</div>
					 <div style="float: left; width: 170px; text-align: center"><input type="checkbox" '.$checked_func.' />'.$checked_func_val.'</div>
					 <div style="float: right;"><input type="button" value="zruš" size="20" onclick="prevedQuery_sirena_delete(document.getElementById(\'id_sirena_'.$pole[0].'\').value)" /></div>
					 <div style="clear: both"></div>
				 </td>
			</tr>
			';
	}
	$html .= '</table>';
	
	return $html;
}

/*-------------------------------------ajaxove spracovanie siren a snimacov------------------------------*/

/*snimace*/

if(isset($_GET["action"])){
	$action = strip_tags($_GET["action"]);
	
	if($action == "select_insp"){
		$id_obj = strip_tags($_GET["id_obj"]);
		
		$sql = "SELECT id_inspector FROM inspector_object_connection WHERE id_object=$id_obj";
		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa vybrať inšpektora");
		
		$data = @pg_fetch_array($res);
			
		$sql = "SELECT * FROM inspector ORDER BY inspector";
		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa vybrať inšpektora");
		
		$insp_input = '<select name="inspector" style="width: 400px">';
		if($data["id_inspector"] == 0)
			$insp_input .= '<option value="0" selected="selected">vyberte inšpektora</option>';
			
		while ($pole=pg_fetch_array($res)) {
			if($pole["id"] == $data["id_inspector"])
				$selected = 'selected="selected"';
			else 
				$selected = '';
			$insp_input .= '<option value="'.$pole["id"].'" '.$selected.'>'.$pole["inspector"].'</option>';
		}	
		$insp_input .= '</select>'; 
		
		die($insp_input);
	}
	elseif($action == "add_snimac"){
		$key = strip_tags($_GET["key"]);
		$idsnimac = strip_tags($_GET["idSnimac"]);
		$cisloformu = strip_tags(str_replace("[amp]","&",$_GET["cisloFormu"]));
		$adresasnimac = strip_tags(str_replace("[amp]","&",$_GET["adresaSnimac"]));
		$popissnimac = strip_tags(str_replace("[amp]","&",$_GET["popisSnimac"]));
		$typsnimac = strip_tags(str_replace("[amp]","&",$_GET["typSnimac"]));
		$funkcnost = strip_tags($_GET["funkcnostSnimac"]);
		$polohasnimac = strip_tags($_GET["polohaSnimac"]);
		$sql = "
			INSERT INTO inspection_form_snimace (key,status,id_snimac,cislo,adresa,popis,typ,funkcnost,poloha)
			VALUES ('$key','0','$idsnimac','$cisloformu','$adresasnimac','$popissnimac','$typsnimac','$funkcnost','$polohasnimac')";

		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa pridať do databazy");
		else{
			die(show_items($key,"snimace"));
		} 	
	}
	elseif($action == "delete_snimac"){
		$key = strip_tags($_GET["key"]);
		$id_item = strip_tags($_GET["id"]);
		//zistim povodny status
		$sql = "SELECT status FROM inspection_form_snimace WHERE id=$id_item";
		if(($res = pg_query($sql)) == false)
			die("database error");
		$status = pg_result($res,0,"status");
		if($status==1)
			$insert = 2;
		else 
			$insert = 3;
		
		
		$sql = "UPDATE inspection_form_snimace SET status=$insert WHERE id = $id_item AND key = $key";
		
		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa vymazať položku s id $id_item");
		else 
			die(show_items($key,"snimace"));		
	}
	elseif($action == "update_snimac"){
		$key = strip_tags($_GET["key"]);
		$id_item = strip_tags($_GET["id_item"]);
		$id = strip_tags($_GET["id"]);
		$cislof = str_replace("[amp]","&",strip_tags($_GET["cislof"]));
		$adresa = strip_tags($_GET["adresa"]);
		$popis = strip_tags($_GET["popis"]);
		$typ = strip_tags($_GET["typ"]);
		$funkcnost = strip_tags($_GET["funkcnost"]);
		$poloha = strip_tags($_GET["poloha"]);
		
		$sql = "UPDATE inspection_form_snimace SET id_snimac='$id', cislo='$cislof', adresa='$adresa', popis='$popis', typ='$typ', funkcnost='$funkcnost', poloha='$poloha' WHERE id = $id_item AND key = $key";
		//die($sql);
	}
	
	/*sireny*/
	
	elseif($action == "add_sirena"){
		$key = strip_tags($_GET["key"]);
		$idsirena = strip_tags($_GET["idSirena"]);
		$cislosirena = strip_tags(str_replace("[amp]","&",$_GET["cisloSirena"]));
		$umiestneniesirena = strip_tags(str_replace("[amp]","&",$_GET["umiestnenieSirena"]));
		$typsirena = strip_tags(str_replace("[amp]","&",$_GET["typSirena"]));
		$zalohovana = strip_tags($_GET["zalohovanaSirena"]);
		$funkcnost = strip_tags($_GET["funkcnostSirena"]);
		$sql = "
			INSERT INTO inspection_form_sireny (key,status,id_sirena,cislo,umiestnenie,typ,zalohovana,funkcnost)
			VALUES ('$key','0','$idsirena','$cislosirena','$umiestneniesirena','$typsirena','$zalohovana','$funkcnost')";
		
		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa pridať do databazy");
		else{
			die(show_items($key,"sireny"));
		} 	
	}
	elseif($action == "delete_sirena"){
		$key = strip_tags($_GET["key"]);
		$id_item = strip_tags($_GET["id"]);
		//zistim povodny status
		$sql = "SELECT status FROM inspection_form_sireny WHERE id=$id_item";
		if(($res = pg_query($sql)) == false)
			die("database error");
		$status = pg_result($res,0,"status");
		if($status==1)
			$insert = 2;
		else 
			$insert = 3;
			
		$sql = "UPDATE inspection_form_sireny SET status=$insert WHERE id = $id_item AND key = $key";
		
		if(($res = pg_query($sql)) == false)
			die("nepodarilo sa vymazať položku s id $id_item");
		else 
			die(show_items($key,"sireny"));		
	}	
	else die ("<br><br><b>Akcia prebehla neúspešne..</b><br><br><br>");
}

$akcia = $_GET["akcia"];


//povinne polozky
if(!empty($_POST["typ"]) or !empty($_POST["poc_zon"])){
	$key = strip_tags($_POST["key"]);
	if(!is_numeric($key)) die ("nastala chyba pri generovani kľúča");
	$input[] = strip_tags($_POST["key"]);
	$input[] = strip_tags($_POST["objekt"]);
	$input[] = strip_tags($_POST["kontrola"]);
	$input[] = strip_tags($_POST["kont_vykonal"]);
	$input[] = strip_tags($_POST["veduci_posty"]);
	$input[] = strip_tags($_POST["inspector"]);
	$input[] = strip_tags($_POST["typ"]);
	$input[] = strip_tags($_POST["poc_zon"]);
	$input[] = strip_tags($_POST["poc_pouz_zon"]);
	$input[] = strip_tags($_POST["komunikator"]); //9
	$input[] = strip_tags($_POST["zalozny_zdroj"]);
	$input[] = strip_tags($_POST["istenie_psn"]);
	$input[] = strip_tags($_POST["samostatne_z_rozvadzaca"]); //12
	$input[] = strip_tags($_POST["prenos_na_pco"]); //13
	$input[] = strip_tags($_POST["stav_prenosu_na_pco"]); //14
	$input[] = strip_tags($_POST["tel_linka"]);
	$input[] = strip_tags($_POST["km_typ_komunikator"]);
	$input[] = strip_tags($_POST["gsm_typ"]);
	$input[] = strip_tags($_POST["radio_typ"]);
	$input[] = strip_tags($_POST["iny_typ"]);
	$input[] = strip_tags($_POST["statna_policia"]); //20
	$input[] = strip_tags($_POST["mestska_policia"]); //21
	$input[] = strip_tags($_POST["sbs"]);
	$input[] = strip_tags($_POST["rozvody_pod_omietkou"]);
	$input[] = strip_tags($_POST["rozvody_pvc_zlab"]);
	$input[] = strip_tags($_POST["rozvody_podhlad"]);
	$input[] = strip_tags($_POST["rozvody_ine"]);
	$input[] = strip_tags($_POST["stav_psn"]);
	$input[] = strip_tags($_POST["zavady"]);
	$input[] = strip_tags($_POST["poznamky"]);
	$input[] = strip_tags($_POST["sbs_ch"]);
	$input[] = strip_tags($_POST["searchByDateFrom"]);
	
	if($input[9] != 't') $input[9] = 'f';
	if($input[12] != 't') $input[12] = 'f';
	if($input[13] != 't') $input[13] = 'f';
	if($input[14] != 't') $input[14] = 'f';
	if($input[20] != 't') $input[20] = 'f';
	if($input[21] != 't') $input[21] = 'f';
	if($input[30] != 't') $input[30] = 'f';

	
}
else{
	$_SESSION["alert"] = "nevyplnili ste všetky povinné položky";
	header("location: index.php");
}

/*-----------------------------------------pridanie formularu------------------------------------*/

if($akcia == "new_form"){
	
	$sql = "
		INSERT INTO inspection_form
			(
			id_form,
			objekt,
			kontrola,
			kont_vykonal,
			veduci_posty,
			inspector,
			typ,
			poc_zon,
			poc_pouz_zon,
			komunikator,
			zalozny_zdroj,
			istenie_psn,
			samostatne_z_rozvadzaca,
			prenos_na_pco,
			stav_prenosu_na_pco,
			tel_linka,
			km_typ_komunikator,
			gsm_typ,
			radio_typ,
			iny_typ,
			statna_policia,
			mestska_policia,
			sbs,
			rozvody_pod_omietkou,
			rozvody_pvc_zlab,
			rozvody_podhlad,
			rozvody_ine,
			stav_psn,
			zavady,
			poznamky,
			sbs_tf,
			instalovane
			)
		VALUES(
			";
	for($i=0;$i<30;$i++){
		$sql .= "'".$input[$i]."',";
		//echo $input[$i].$i."<br>";
	}
	$sql .= "'".$input[30]."',";
	$sql .= "'".$input[31]."');";
	
	$sql_final = "BEGIN TRANSACTION;";
	
	$sql_final .= $sql;
	$sql_final .= "UPDATE inspection_form_snimace SET status=1 WHERE key=$key AND status=0;";
	$sql_final .= "UPDATE inspection_form_sireny SET status=1 WHERE key=$key AND status=0;";
	/* vydeletuje kde je status 0 po nedokoncenych formularoch*/
	//$sql_final .= "DELETE FROM inspection_form_sireny WHERE status = 0";
	//$sql_final .= "DELETE FROM inspection_form_snimace WHERE status = 0";
	$sql_final .= "DELETE FROM inspection_form_sireny WHERE key=$key AND status = 3;";
	$sql_final .= "DELETE FROM inspection_form_snimace WHERE key=$key AND status = 3;";
	
	$sql_final .= "UPDATE inspection_form_sireny SET status=1 WHERE key=$key AND status=2;";
	$sql_final .= "UPDATE inspection_form_snimace SET status=1 WHERE key=$key AND status=2;";
	
	$sql_final .= "COMMIT TRANSACTION;";
	
	if(($res = pg_query($sql_final)) == false){
		$_SESSION["alert"] = "nepodarilo sa pridať formulár do databázy";
		header("location: index.php");
	}
	else{
		$_SESSION["alert"] = "formulár bol úspešne pridaný do databázy";
		header("location: index.php");
	}
}


	/*-----------------------------------------editacia formularu------------------------------------*/

elseif($akcia=="edit_formu"){
	
	$sql = "
		UPDATE inspection_form
			
			SET objekt 				= $input[1], 
			kontrola 				= '$input[2]',
			kont_vykonal 			= '$input[3]',
			veduci_posty			= '$input[4]',
			inspector 				= $input[5],
			typ 					= '$input[6]',
			poc_zon 				= '$input[7]',
			poc_pouz_zon 			= '$input[8]',
			komunikator 			= '$input[9]',
			zalozny_zdroj 			= '$input[10]',
			istenie_psn 			= '$input[11]',
			samostatne_z_rozvadzaca = '$input[12]',
			prenos_na_pco 			= '$input[13]',
			stav_prenosu_na_pco 	= '$input[14]',
			tel_linka 				= '$input[15]',
			km_typ_komunikator 		= '$input[16]',
			gsm_typ 				= '$input[17]',
			radio_typ 				= '$input[18]',
			iny_typ 				= '$input[19]',
			statna_policia 			= '$input[20]',
			mestska_policia 		= '$input[21]',
			sbs 					= '$input[22]',
			rozvody_pod_omietkou 	= '$input[23]',
			rozvody_pvc_zlab 		= '$input[24]',
			rozvody_podhlad 		= '$input[25]',
			rozvody_ine 			= '$input[26]',
			stav_psn 				= '$input[27]',
			zavady 					= '$input[28]',
			poznamky 				= '$input[29]',
			sbs_tf					= '$input[30]',
			instalovane				= '$input[31]'
			
		WHERE id=$_POST[id_form];";
	

	
	$sql_final = "BEGIN TRANSACTION;";
	
	$sql_final .= $sql;
	$sql_final .= "UPDATE inspection_form_snimace SET status=1 WHERE key=$key AND status=0;";
	$sql_final .= "UPDATE inspection_form_sireny SET status=1 WHERE key=$key AND status=0;";
	
	$sql_final .= "COMMIT TRANSACTION;";
	
	if(($res = pg_query($sql_final)) == false){
		$_SESSION["alert"] = "nepodarilo sa pridať formulár do databázy";
		header("location: index.php");
	}
	else{
		$_SESSION["alert"] = "formulár bol úspešne zmenený";
		header("location: index.php");
	}
}


?>
