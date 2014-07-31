<?php
/* najskor vydeletuje kde je status 0 po nedokoncenych formularoch
$sql = "
DELETE FROM inspection_form_sireny WHERE status = 0;
DELETE FROM inspection_form_snimace WHERE status = 0;
DELETE FROM inspection_form_sireny WHERE status = 3;
DELETE FROM inspection_form_snimace WHERE status = 3";
if(($res = pg_query($sql))==false)
		die("error document 0a");
		
/* potom updatene kde je status 3 po nedokoncenych formularoch
$sql = "
UPDATE inspection_form_sireny SET status=1 WHERE status=2;
UPDATE inspection_form_snimace SET status=1 WHERE status=2";
if(($res = pg_query($sql))==false)
		die("error document 0b");
		
pg_free_result($res);
*/	
		
$load = $_GET["load"];
$akcia = $_GET["akcia"];
$id = $_GET["id"];

if($akcia=="edit" || $akcia=="print"){
	$sql = "SELECT * FROM inspection_form where id = $id";
	if(($res = pg_query($sql))==false)
		die("error document 1");
		
	$data = pg_fetch_array($res);

	$sql_obj = "SELECT * FROM object ORDER BY mesto";
	if(($res_obj = pg_query($sql_obj))==false)
		die("error document 2");
	
	$object = '<option value="0">vyberte objekt</option>';
	while ($pole=pg_fetch_array($res_obj)) {
		if($pole["id"]==$data["objekt"])
			$selected = "selected";
		else 
			$selected = "";
		$object .= '<option value="'.$pole["id"].'" '.$selected.'>'.$pole["mesto"].', '.$pole["adresa_posty"].'</option>';
	}
	
	$sql_ins = "SELECT * FROM inspector ORDER BY inspector";
	$res_ins = pg_query($sql_ins);
	
	$inspector = '<option value="0">vyberte inšpektora</option>';
	while ($pole=pg_fetch_array($res_ins)) {
		if($pole["id"]==$data["inspector"])
			$selected = "selected";
		else 
			$selected = "";
		$inspector .= '<option value="'.$pole["id"].'" '.$selected.'>'.$pole["inspector"].'</option>';
	}
	
	
}
else {
	$sql = "SELECT * FROM object ORDER BY mesto";
	if(($res = pg_query($sql))==false)
		die("error document 2");
	
	$object = '<option value="0">vyberte objekt</option>';
	while ($pole=pg_fetch_array($res)) {
		$object .= '<option value="'.$pole["id"].'">'.$pole["mesto"].', '.$pole["adresa_posty"].'</option>';
	}
	
	$sql = "SELECT * FROM inspector ORDER BY inspector";
	$res = pg_query($sql);
	
	$inspector = '<option value="0">vyberte inšpektora</option>';
	while ($pole=pg_fetch_array($res)) {
		$inspector .= '<option value="'.$pole["id"].'">'.$pole["inspector"].'</option>';
	}
	
	//generuje kluc
	$key = explode(" ",microtime());
	$key = explode(".",$key[0]);
	$key = $key[1];
}

function show_items($key,$table){
	$sql = "SELECT * FROM inspection_form_$table WHERE key = $key AND status = 1 ORDER BY id";

	if(($res = pg_query($sql)) == false)
		die("nepodarilo sa zobrziť výsledky");
		
	$html = '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
	
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
						 <input type="hidden" name="id_snimac" value="'.$pole[0].'" id="id_snimac_'.$pole[0].'" />
						 <input type="text" value="'.$pole[2].'" size="1" class="input_t" id="snimac_id_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[4].'" size="6" class="input_t" id="snimac_adresa_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[5].'" size="40" class="input_t" id="snimac_popis_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[6].'" size="10" class="input_t" id="snimac_typ_'.$pole[0].'" />
					 </div>
					 <div style="float: left; width: 142px"><input type="checkbox" '.$checked_func.' id="snimac_funkcnost_'.$pole[0].'" value="true" />'.$checked_func_val.'</div>
					 <div style="float: left; width: 120px"><input type="checkbox" '.$checked_poloha.' id="snimac_poloha_'.$pole[0].'" value="true" />'.$checked_poloha_val.'</div>
				 	 <!--<div style="float: left"><input type="button" class="button_print" value="uprav" onclick="prevedQuery_snimac_update(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" />&nbsp;<input type="button" class="button_print" value="zruš" onclick="prevedQuery_snimac_delete(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" /></div>-->
				 	 <div style="float: right;"><input type="button" value="uprav" size="20" onclick="prevedQuery_snimac_update(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" /><input type="button" value="zruš" size="20" onclick="prevedQuery_snimac_delete(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" /></div>
				 	 <!--<div style="float: left"><input type="button" class="button_print" value="zruš" onclick="prevedQuery_snimac_delete(document.getElementById(\'id_snimac_'.$pole[0].'\').value)" /></div>-->
				 	 <div style="clear: both"></div>
				 <td>
			</tr>
			';
		if($table == "sireny")
			$html .= '
			<tr>
				<td>
					 <div style="float: left">
						 <input type="hidden" name="id_sirena" value="'.$pole[0].'" id="id_sirena_'.$pole[0].'" />
						 <input type="text" value="'.$pole[2].'" size="1" class="input_t" id="sirena_id_'.$pole[0].'" />&nbsp;
						 <input type="hidden" value="'.$pole[3].'" size="15" class="input_t" id="sirena_cislo_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[4].'" size="25" class="input_t" id="sirena_umiestnenie_'.$pole[0].'" />&nbsp;
						 <input type="text" value="'.$pole[5].'" size="20" class="input_t" id="sirena_typ_'.$pole[0].'" />
					 </div>
					 <div style="float: left; width: 210px; text-align: center"><input type="checkbox" id="sirena_zalohovana_'.$pole[0].'" value="true" '.$checked_zaloha.' />'.$checked_zaloha_val.'</div>
					 <div style="float: left; width: 140px; text-align: center"><input type="checkbox" id="sirena_funkcnost_'.$pole[0].'" value="true" '.$checked_func.' />'.$checked_func_val.'</div>
					 <!--<div style="float: left;"><input type="button" class="button_print" value="uprav" />&nbsp;<input type="button" class="button_print" value="zruš" size="20" onclick="prevedQuery_sirena_delete(document.getElementById(\'id_sirena_'.$pole[0].'\').value)" /></div>-->
					 <div style="float: right;"><input type="button" value="uprav" size="20" onclick="prevedQuery_sirena_update(document.getElementById(\'id_sirena_'.$pole[0].'\').value)" /><input type="button" value="zruš" size="20" onclick="prevedQuery_sirena_delete(document.getElementById(\'id_sirena_'.$pole[0].'\').value)" /></div>
					 <div style="clear: both"></div>
				 </td>
			</tr>
			';
	}
	$html .= '</table>';
	
	return $html;
}

function show_id($key,$table){
	if ($table=='snimace') 
		$sql = "SELECT MAX(id_snimac) AS maxid FROM inspection_form_$table WHERE key = $key AND status = 1;";
	else
		$sql = "SELECT MAX(id_sirena) AS maxid FROM inspection_form_$table WHERE key = $key AND status = 1;";
	if(($res = pg_query($sql)) == false)
		die("nepodarilo sa zobraziť výsledky");
		
	if ($pole = pg_fetch_row($res)){
		return($pole[0]+1);
	}
	else {
		return "1";
	}
}


?>

<script type="text/javascript">

<?php if($akcia=="print") echo "window.print()"; ?>

var xmlHttp;

function vytvorXMLHttpRequest() {
  if (window.ActiveXObject) {
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  else if (window.XMLHttpRequest) {
    xmlHttp = new XMLHttpRequest();
  }
}

function prevedQuery_snimac_delete(input){
	vytvorXMLHttpRequest();
	
	var key = document.getElementById("key").value;
	var query = "/formular/spracuj.php?action=delete_snimac&key=" + key;
    query =  query + "&id=" + input + "&key=" + key;
    query =  query + "&uique=" + new Date().getTime(); 
    xmlHttp.onreadystatechange = spracujZmenuStavu_snimac;

    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}

function prevedQuery_snimac_update(input){
	vytvorXMLHttpRequest();
	
	var key = document.getElementById("key").value;
	
	var id = document.getElementById("snimac_id_"+input).value;
	//var cislof = document.getElementById("snimac_cislof_"+input).value.replace("&","[amp]");
	var adresa = document.getElementById("snimac_adresa_"+input).value.replace("&","[amp]");
	var popis = document.getElementById("snimac_popis_"+input).value.replace("&","[amp]");
	var typ = document.getElementById("snimac_typ_"+input).value.replace("&","[amp]");
	
	var funkcnost = document.getElementById("snimac_funkcnost_"+input).checked;
	var poloha = document.getElementById("snimac_poloha_"+input).checked;
	
	var query = "/formular/spracuj.php?action=update_snimac&key=" + key;
    query =  query + "&id_item=" + input + "&id=" + id + "&adresa=" + adresa + "&popis=" + popis+ "&typ=" + typ+ "&funkcnost=" + funkcnost + "&poloha=" + poloha;
    query =  query + "&uique=" + new Date().getTime(); 
    
    xmlHttp.onreadystatechange = spracujZmenuStavu_snimac;
    
    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}





function prevedQuery_snimac() {
  vytvorXMLHttpRequest();

	var key = document.getElementById("key").value;
	var idSnimac = document.getElementById("idSnimac").value;
	//var cisloFormu = document.getElementById("cisloFormu").value.replace("&","[amp]");
	var adresaSnimac = document.getElementById("adresaSnimac").value.replace("&","[amp]");
	var popisSnimac = document.getElementById("popisSnimac").value.replace("&","[amp]");
	var typSnimac = document.getElementById("typSnimac").value.replace("&","[amp]");
	var funkcnostSnimac = document.getElementById("funkcnostSnimac").checked;
	var polohaSnimac = document.getElementById("polohaSnimac").checked;	  
  
  var query = "/formular/spracuj.php?action=add_snimac&key=" + key;
  query =  query + "&idSnimac=" + idSnimac + "&adresaSnimac=" + adresaSnimac + "&popisSnimac=" + popisSnimac + "&typSnimac=" + typSnimac + "&funkcnostSnimac=" + funkcnostSnimac + "&polohaSnimac=" + polohaSnimac;
  query =  query + "&uique=" + new Date().getTime(); 
  xmlHttp.onreadystatechange = spracujZmenuStavu_snimac;

  xmlHttp.open("GET", query, true);
  xmlHttp.send(null);
}

function spracujZmenuStavu_snimac() {
  if(xmlHttp.readyState == 4) {
    if(xmlHttp.status == 200) {
      var odpoved = document.getElementById("vysledky");
	  if(odpoved.hasChildNodes()) {
	    odpoved.removeChild(odpoved.childNodes[0]);
	  }
	  
	  document.getElementById("vysledky").innerHTML = xmlHttp.responseText;
	}
  }
}

/**************************************************************/

function prevedQuery_sirena() {
  vytvorXMLHttpRequest();
  
	var key = document.getElementById("key").value;
	var idSirena = document.getElementById("idSirena").value;
	var cisloSirena = document.getElementById("cisloSirena").value.replace("&","[amp]");
	var umiestnenieSirena = document.getElementById("umiestnenieSirena").value.replace("&","[amp]");
	var typSirena = document.getElementById("typSirena").value.replace("&","[amp]");
	var zalohovanaSirena = document.getElementById("zalohovanaSirena").checked;
	var funkcnostSirena = document.getElementById("funkcnostSirena").checked;
  
  var query = "/formular/spracuj.php?action=add_sirena&key=" + key;
  query =  query + "&idSirena=" + idSirena + "&cisloSirena=" + cisloSirena + "&umiestnenieSirena=" + umiestnenieSirena + "&typSirena=" + typSirena + "&zalohovanaSirena=" + zalohovanaSirena + "&funkcnostSirena=" + funkcnostSirena;
  query =  query + "&uique=" + new Date().getTime(); 
  xmlHttp.onreadystatechange = spracujZmenuStavu_sirena;

  xmlHttp.open("GET", query, true);
  xmlHttp.send(null);
}

function spracujZmenuStavu_sirena() {
  if(xmlHttp.readyState == 4) {
    if(xmlHttp.status == 200) {
      var odpoved = document.getElementById("vysledky2");
	  if(odpoved.hasChildNodes()) {
	    odpoved.removeChild(odpoved.childNodes[0]);
	  }
	  
	  document.getElementById("vysledky2").innerHTML = xmlHttp.responseText;
	}
  }
}

function prevedQuery_sirena_delete(input){
	vytvorXMLHttpRequest();
	
	var key = document.getElementById("key").value;
	var query = "/formular/spracuj.php?action=delete_sirena";
    query =  query + "&id=" + input + "&key=" + key;
    query =  query + "&uique=" + new Date().getTime(); 
    xmlHttp.onreadystatechange = spracujZmenuStavu_sirena;

    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}

function prevedQuery_sirena_update(input){
	vytvorXMLHttpRequest();
	
	var key = document.getElementById("key").value;
	
	var id = document.getElementById("sirena_id_"+input).value;
	var cislo = document.getElementById("sirena_cislo_"+input).value.replace("&","[amp]");
	var umiestnenie = document.getElementById("sirena_umiestnenie_"+input).value.replace("&","[amp]");
	var typ = document.getElementById("sirena_typ_"+input).value.replace("&","[amp]");
	var zalohovana = document.getElementById("sirena_zalohovana_"+input).checked;
	var funkcnost = document.getElementById("sirena_funkcnost_"+input).checked;
	
	var query = "/formular/spracuj.php?action=update_sirena&key=" + key;
    query =  query + "&id_item=" + input + "&id=" + id + "&cislo=" + cislo+ "&umiestnenie=" + umiestnenie + "&typ=" + typ+ "&zalohovana=" + zalohovana+ "&funkcnost=" + funkcnost;
    query =  query + "&uique=" + new Date().getTime(); 
    
    xmlHttp.onreadystatechange = spracujZmenuStavu_sirena;
    
    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}


function vyberInspectora(input){
	vytvorXMLHttpRequest();
	
	var query = "/formular/spracuj.php?action=select_insp&id_obj=" + input;
    xmlHttp.onreadystatechange = spracujZmenuStavu_vyberInsp;

    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}

function spracujZmenuStavu_vyberInsp() {
  if(xmlHttp.readyState == 4) {
    if(xmlHttp.status == 200) {
      var odpoved = document.getElementById("vysledky_insp");
	  if(odpoved.hasChildNodes()) {
	    odpoved.removeChild(odpoved.childNodes[0]);
	  }
	  
	  document.getElementById("vysledky_insp").innerHTML = xmlHttp.responseText;
	}
  }
}

function clearLine(type){
	if(type=="snimace"){
		obj = document.getElementById("idSnimac");
		obj.value =  parseInt(obj.value)+1;
		//document.getElementById("cisloFormu").value="";
		document.getElementById("adresaSnimac").value="";
		document.getElementById("popisSnimac").value="";
		document.getElementById("typSnimac").value="";
		document.getElementById("funkcnostSnimac").checked=false;
		document.getElementById("funkcnostSnimac2").checked=false;
		document.getElementById("polohaSnimac").checked=false;
		document.getElementById("polohaSnimac2").checked=false;
	}
	else if(type=="sireny"){
		obj2 = document.getElementById("idSirena");
		obj2.value = parseInt(obj2.value)+1;
		document.getElementById("cisloSirena").value="";
		document.getElementById("umiestnenieSirena").value="";
		document.getElementById("typSirena").value="";
		document.getElementById("zalohovanaSirena").checked=false;
		document.getElementById("funkcnostSirena").checked=false;
		document.getElementById("funkcnostSirena2").checked=false;
		document.getElementById("zalohovanaSirena2").checked=false;
		
	}
}

</script>

<form action="/formular/spracuj.php?akcia=<?php if($akcia=="edit") echo "edit_formu"; else echo "new_form"; ?>" method="post" name="userForm">
<input type="hidden" name="key" value="<?php if($akcia=="edit") echo $data[id_form]; else echo $key; ?>" id="key" />
<table border="0" cellpadding="5" cellspacing="0" width="880" align="center">
<tbody>
	<tr>
		<td>		
			ID formuláru<span style="font-size: 10px; font-weight: normal; color: #4444"> (vyplní sa automaticky)</span><br />
			<input type="text" name="id_form" value="<?php echo $data[id]; ?>" size="25" />
		</td>
		<td align="right"><div class="button_print"><a href="<?php if($akcia=="edit" || $akcia=="print") echo "index.php?load=zoznam"; else echo "admin/" ;?>">&laquo; do adminu</a></div></td>
	</tr>
	<tr>
		<td colspan="2">
		<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			Objekt (Mesto a adresa pošty)<br />
			<select name="objekt" style="width: 800px" onchange="vyberInspectora(this.value);"><?php echo $object; ?></select><br /><br />
			Kontrola vykonaná dňa: <input type="text" name="kontrola" value="<?php echo $data[kontrola]; ?>" style="width: 70px" /> Kontrolu vykonal: <input type="text" name="kont_vykonal" value="<?php echo $data[kont_vykonal]; ?>" style="width: 200px" /><br /><br />
			Meno a kontakt vedúceho pošty: <input type="text" name="veduci_posty" value="<?php echo $data[veduci_posty]; ?>"  style="width: 400px" /><br /><br />
			Zodpovedný inšpektor / telefón: <div id="vysledky_insp" style="display: inline"><select name="inspector" style="width: 400px"><?php echo $inspector; ?></select></div>
			</div>
			<br />
			<br />
			
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<span style="font-weight:bold;color:red"><u>TYP*:</u></span> <input type="text" name="typ" value="<?php echo $data[typ]; ?>" style="width: 200px" id="povinne1" /> <span style="font-weight:bold;color:red"><u>Počet zón*:</u></span> <input type="text" name="poc_zon" value="<?php echo $data[poc_zon]; ?>" style="width: 30px" id="povinne2" /> Počet použitých zón: <input type="text" name="poc_pouz_zon" value="<?php echo $data[poc_pouz_zon]; ?>" style="width: 30px" />
			
			Inštalované dňa: <input name="searchByDateFrom" size="16" id="searchByDateFrom" value="<?php echo $data[instalovane]; ?>" type="text" />
			
			<script type="text/javascript">
				document.writeln('<img id="sdate[str]-trigger" src="<?php if($akcia=="edit") echo "../";?>pics/system/calendar.png" title="Vyber deň" style="cursor: pointer;" class="icon" />');
				Calendar.setup(
				{
				inputField  : "searchByDateFrom",
				button      : "sdate[str]-trigger"
				}
				);
					
				function getDate(){
					var date = document.getElementById("searchByDateFrom").value;
					alert(date);
				}
			</script>
			
			
			<br /><br />
			Komunikátor: <label><input type="radio" name="komunikator" value="t" <? if($data[komunikator]=="t") echo "checked"; ?> />áno</label> <label><input type="radio" name="komunikator" value="f" <? if($data[komunikator]=="f") echo "checked"; ?> />nie</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Záložný zdroj - kapacita Ah: <input type="text" name="zalozny_zdroj" value="<?php echo $data[zalozny_zdroj]; ?>" style="width: 90px" /><br /><br />
			Istenie PSN: <input type="text" name="istenie_psn" value="<?php echo $data[istenie_psn]; ?>" style="width: 90px" /> Samostatné z rozvádzača: <label><input type="radio" name="samostatne_z_rozvadzaca" value="t" <? if($data[samostatne_z_rozvadzaca]=="t") echo "checked"; ?> />áno</label> <label><input type="radio" name="samostatne_z_rozvadzaca" value="f" <? if($data[samostatne_z_rozvadzaca]=="f") echo "checked"; ?> />nie</label><br /><br />
			Prenos na PCO:<label><input type="radio" name="prenos_na_pco" value="t" <? if($data[prenos_na_pco]=="t") echo "checked"; ?> />áno</label> <label><input type="radio" name="prenos_na_pco" value="f" <? if($data[prenos_na_pco]=="f") echo "checked"; ?> />nie</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stav prenosu na PCO: <label><input type="radio" name="stav_prenosu_na_pco" value="t" <? if($data[stav_prenosu_na_pco]=="t") echo "checked"; ?> />funkčný</label> <label><input type="radio" name="stav_prenosu_na_pco" value="f" <? if($data[stav_prenosu_na_pco]=="f") echo "checked"; ?> />nefunkčný</label><br /><br />			
			</div>
			<br />
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<b>Spôsob prenosu na PCO</b><br /><br />
			<table border="0" cellpadding="0" cellspacing="3" style="margin-left: 50px">
				<tr>
					<td>Tel. linka:</td>
					<td> <input type="text" name="tel_linka" value="<?php echo $data[tel_linka]; ?>" style="width: 100px" /></td>
					<td>KM-typ, Komunikátor: </td>
					<td> <input type="text" name="km_typ_komunikator" value="<?php echo $data[km_typ_komunikator]; ?>" style="width: 100px" /></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>GSM - typ: </td>
					<td> <input type="text" name="gsm_typ" value="<?php echo $data[gsm_typ]; ?>" style="width: 100px" /> </td>
					<td> Radio - typ: </td>
					<td> <input type="text" name="radio_typ" value="<?php echo $data[radio_typ]; ?>" style="width: 100px" /> </td>
					<td> Iný typ - uviesť: </td>
					<td> <input type="text" name="iny_typ" value="<?php echo $data[iny_typ]; ?>" style="width: 100px" /> </td>
				</tr>
			</table>
			</div>
			<br /><br />
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<b>Ochranu zabezpečuje:</b><br />
			<table border="0" cellpadding="0" cellspacing="3" style="margin-left: 50px" width="100%">
				<tr>
					<td>Štátna polícia: <input type="checkbox" name="statna_policia" value="t" <? if($data[statna_policia]=='t') echo "checked";?> /></td>
					<td>Mestská polícia: <input type="checkbox" name="mestska_policia"  value="t" <? if($data[mestska_policia]=='t') echo "checked";?> /></td>
					<td>SBS <input type="checkbox" name="sbs_ch"  value="t" <? if($data[sbs_tf]=='t') echo "checked";?> /> uviesť názov:  <input type="text" name="sbs" style="width: 120px" value="<?php echo $data[sbs]; ?>" /></td>
				</tr>
			</table>
			</div>
			<br /><br />
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<b>Snímače</b><br /><br />
			 
			<table border="0" cellpadding="0" cellspacing="3">
				<tr>
					<td>Id</td>
					<!-- <td>Číslo f.</td> -->
					<td>Adresa</td>
					<td>Popis</td>
					<td>Typ snímača</td>
					<td>&nbsp;&nbsp;Funkčnosť</td>
					<td>Poloha</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="8">
						<div id="vysledky">
						<?php
							if($akcia=="edit" || $akcia=="print"){
								echo show_items($data[id_form],"snimace");
							}
						?>
						</div>
					</td>
				</tr>
				<tr>
					<td> <input name="idSnimac" id="idSnimac" type="text" value="<?php if($akcia=="edit"){echo show_id($data[id_form],"snimace");}else{echo "1";} ?>" size="1"  class="button_print" /></td>
					<!-- <td> <input name="cisloFormu" id="cisloFormu" type="text" value="" size="5"  class="button_print" /></td> -->
					<td> <input name="adresaSnimac" id="adresaSnimac" type="text" value="" size="6" class="button_print" /></td>
					<td> <input name="popisSnimac" id="popisSnimac" type="text" value="" size="40" class="button_print" /></td>
					<td> <input name="typSnimac" id="typSnimac" type="text" value="" size="15" class="button_print" /></td>
					<td> <input type="radio" name="funkcnostSnimac" id="funkcnostSnimac" value="t" class="button_print" />funguje <input type="radio" name="funkcnostSnimac" id="funkcnostSnimac2" value="f"  class="button_print" />nefunguje</td>
					<td> <input type="radio" name="polohaSnimac" id="polohaSnimac" value="t" class="button_print" />vyhovuje<input type="radio" name="polohaSnimac" id="polohaSnimac2" value="f"  class="button_print" />nevyhovuje</td>
					<td> <input type="button" value="pridaj" size="20" onclick="prevedQuery_snimac(); clearLine('snimace');" class="button_print" /></td>
				</tr>
			</table>
			</div>
			<br /><br />
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<b>Sirény</b><br /><br />
			
			<table border="0" cellpadding="0" cellspacing="3">
				<tr>
					<td>Id</td>
					<td></td>
					<td>Umiestnenie</td>
					<td>Typ-uviesť</td>
					<td align="center">Záloha</td>
					<td align="center">Funkčnosť</td>
				</tr>
				<tr>
					<td colspan="8">
						<div id="vysledky2">
						<?php
							if($akcia=="edit"|| $akcia=="print"){
								echo show_items($data[id_form],"sireny");
							}
						?>
						</div>
					</td>
				</tr>
				<tr>
					<td> <input name="idSirena" id="idSirena" type="text" value="<?php if($akcia=="edit"){echo show_id($data[id_form],"sireny");}else{echo "1";} ?>" size="1" class="button_print" /></td>
					<td> <input name="cisloSirena" id="cisloSirena" type="hidden" value="" size="15" class="button_print" /></td>
					<td> <input name="umiestnenieSirena" id="umiestnenieSirena" type="text" value="" size="25" class="button_print" /></td>
					<td> <input name="typSirena" id="typSirena" type="text" value="" size="20" class="button_print" /></td>
					<td> <input type="radio" name="zalohovanaSirena" id="zalohovanaSirena" value="t" class="button_print" />zálohovaná <input type="radio" name="zalohovanaSirena" id="zalohovanaSirena2" value="f" class="button_print" />nezálohovaná</td>
					<td> <input type="radio" name="funkcnostSirena" id="funkcnostSirena" value="t" class="button_print" />funguje <input type="radio" name="funkcnostSirena" id="funkcnostSirena2" value="t" class="button_print" />nefunguje</td>
					<td> <input type="button" value="pridaj" size="20" onclick="prevedQuery_sirena(); clearLine('sireny');" class="button_print" /></td>
				</tr>
			</table>
			</div>
			<br /><br />
			<div style="background-color: #AFE1FF;padding: 10px;border: 1px solid #5BB9F3;">
			<b>Inštalačné rozvody</b><br /><br />
			<table border="0" cellpadding="0" cellspacing="3">
				<tr valign="top">
					<td>
						Pod omietkou:<br />
						<textarea name="rozvody_pod_omietkou" cols="30" rows="4"><? echo $data[rozvody_pod_omietkou]; ?></textarea>
					</td>
					<td>
						PVC žľab:<br />
						<textarea name="rozvody_pvc_zlab" cols="30" rows="4"><? echo $data[rozvody_pvc_zlab]; ?></textarea>
					</td>
					<td>
						Podhľad:<br />
						<textarea name="rozvody_podhlad" cols="30" rows="4"><? echo $data[rozvody_podhlad]; ?></textarea><br/>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					Iné:<br />	
					<textarea name="rozvody_ine" cols="97" rows="4"><? echo $data[rozvody_ine]; ?></textarea>
				</td>
				</tr>
				<tr valign="top">
					<td>
						Stav PSN (funkčná/nefunkčná):<br />
						<textarea name="stav_psn" cols="30" rows="7"><? echo $data[stav_psn]; ?></textarea>
					</td>
					<td>
						Závady:<br />
						<textarea name="zavady" cols="30" rows="7"><? echo $data[zavady]; ?></textarea>
					</td>
					<td>
						Poznámky:<br />
						<textarea name="poznamky" cols="30" rows="7"><? echo $data[poznamky]; ?></textarea>		
					</td>
				</tr>
				
			</table><br />
			<script type="text/javascript">
				function checkForm(){
					var pov1 = document.getElementById('povinne1').value;
					var pov2 = document.getElementById('povinne2').value;
					if(pov1 == '' || pov2 == ''){
						alert('Nevyplnili ste všetky povinné položky: TYP, Počet zón');
						return false;	
					}
					else 
						return true;
				}
			</script>
			</div>
			<br />
			<div  class="button_print">
			<span style="font-weight:bold;color:red">ÚDAJE ZVÝRAZNENÉ ČERVENOU FARBOU A * SÚ POVINNÉ!</span><br /><br />
			<?php if($akcia!="print") echo '<input type="reset" value="Pôvodné údaje" /> <input type="submit" value="Odoslať údaje na sever" onclick="return checkForm();" />'; else echo '<input type="button" value="vytlačiť formulár" onclick="window.print();" />'; ?>
			</div>
		</td>
	</tr>
</tbody>
</table>
</form>
