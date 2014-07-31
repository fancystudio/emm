<?php

//pg_connect("dbname=emm") or die ("nenadviazalo sa spojenie so serverom<br />");
pg_connect("user=emm dbname=emm password=emmsk") or die ("nenadviazalo sa spojenie so serverom<br />");


$sql = "SELECT * FROM object ORDER BY mesto";
$res = pg_query($sql);

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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
		
<title>EMM form</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="styles/form_css.css" media="screen" />

<meta http-equiv="Cache-Control" content="no-store, no-cache"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>

<script type="text/javascript">

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
	var query = "spracuj.php?action=delete_snimac&key=" + key;
    query =  query + "&id=" + input + "&key=" + key;
    query =  query + "&uique=" + new Date().getTime(); 
    xmlHttp.onreadystatechange = spracujZmenuStavu_snimac;

    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}

function prevedQuery_snimac() {
  vytvorXMLHttpRequest();

	var key = document.getElementById("key").value;
	var idSnimac = document.getElementById("idSnimac").value;
	var cisloFormu = document.getElementById("cisloFormu").value;
	var adresaSnimac = document.getElementById("adresaSnimac").value;
	var popisSnimac = document.getElementById("popisSnimac").value;
	var typSnimac = document.getElementById("typSnimac").value;
	var funkcnostSnimac = document.getElementById("funkcnostSnimac").checked;
	var polohaSnimac = document.getElementById("polohaSnimac").checked;	  
  
  var query = "spracuj.php?action=add_snimac&key=" + key;
  query =  query + "&idSnimac=" + idSnimac + "&cisloFormu=" + cisloFormu + "&adresaSnimac=" + adresaSnimac + "&popisSnimac=" + popisSnimac + "&typSnimac=" + typSnimac + "&funkcnostSnimac=" + funkcnostSnimac + "&polohaSnimac=" + polohaSnimac;
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
	var cisloSirena = document.getElementById("cisloSirena").value;
	var umiestnenieSirena = document.getElementById("umiestnenieSirena").value;
	var typSirena = document.getElementById("typSirena").value;
	var zalohovanaSirena = document.getElementById("zalohovanaSirena").checked;
	var funkcnostSirena = document.getElementById("funkcnostSirena").checked;
  
  var query = "spracuj.php?action=add_sirena&key=" + key;
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
	var query = "spracuj.php?action=delete_sirena&key=" + key;
    query =  query + "&id=" + input + "&key=" + key;
    query =  query + "&uique=" + new Date().getTime(); 
    xmlHttp.onreadystatechange = spracujZmenuStavu_sirena;

    xmlHttp.open("GET", query, true);
    xmlHttp.send(null);
}

function vyberInspectora(input){
	vytvorXMLHttpRequest();
	
	var query = "spracuj.php?action=select_insp&id_obj=" + input;
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
		document.getElementById("idSnimac").value="";
		document.getElementById("cisloFormu").value="";
		document.getElementById("adresaSnimac").value="";
		document.getElementById("popisSnimac").value="";
		document.getElementById("typSnimac").value="";
		document.getElementById("funkcnostSnimac").checked=false;
		document.getElementById("funkcnostSnimac2").checked=false;
		document.getElementById("polohaSnimac").checked=false;
		document.getElementById("polohaSnimac2").checked=false;
	}
	else if(type=="sireny"){
		document.getElementById("idSirena").value="";
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

</head>

<body>

<form action="spracuj.php" method="post" name="userForm">
<input type="hidden" name="key" value="<?php echo $key; ?>" id="key" />
<table border="0" cellpadding="5" cellspacing="0" width="900" align="center" class="form_table">
<tbody>
	<tr>
		<td>
			ID formuláru<span style="font-size: 10px; font-weight: normal; color: #4444"> (vyplní sa automaticky)</span><br />
			<input type="text" name="id_form" size="25" />
		</td>
		<td align="right"><img src="pics/system/emm_logo_form.gif" alt="EMM logo" /></td>
	</tr>
	<tr>
		<td colspan="2">
			Objekt (Mesto a adresa pošty)<br />
			<select name="objekt" style="width: 800px" onchange="vyberInspectora(this.value);"><?php echo $object; ?></select><br />
			Kontrola vykonaná dňa: <input type="text" name="kontrola" style="width: 60px" /> Kontrolu vykonal: <input type="text" name="kont_vykonal" style="width: 200px" /><br />
			Meno a kontakt vedúceho pošty: <input type="text" name="veduci_posty" style="width: 400px" /><br />
			Zodpovedný inšpektor / telefón: <div id="vysledky_insp" style="display: inline"><select name="inspector" style="width: 400px"><?php echo $inspector; ?></select></div>
			<br />
			<br />
			<span style="font-weight:bold;color:red"><u>TYP*:</u></span> <input type="text" name="typ" style="width: 200px" id="povinne1" /> <span style="font-weight:bold;color:red"><u>Počet zón*:</u></span> <input type="text" name="poc_zon" style="width: 30px" id="povinne2" /> Počet použitých zón: <input type="text" name="poc_pouz_zon" style="width: 30px" /><br />
			Komunikátor: <label><input type="radio" name="komunikator" value="t" />áno</label> <label><input type="radio" name="komunikator" value="f" />nie</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Záložný zdroj - kapacita Ah: <input type="text" name="zalozny_zdroj" style="width: 90px" /><br />
			Istenie PSN: <input type="text" name="istenie_psn" style="width: 90px" /> Samostatné z rozvádzača: <label><input type="radio" name="samostatne_z_rozvadzaca" value="t" />áno</label> <label><input type="radio" name="samostatne_z_rozvadzaca" value="f" />nie</label><br />
			Prenos na PCO:<label><input type="radio" name="prenos_na_pco" value="t" />áno</label> <label><input type="radio" name="prenos_na_pco" value="f" />nie</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stav prenosu na PCO: <label><input type="radio" name="stav_prenosu_na_pco" value="t" />funkčný</label> <label><input type="radio" name="stav_prenosu_na_pco" value="f" />nefunkčný</label><br />
			Spôsob prenosu na PCO 
			<table border="0" cellpadding="0" cellspacing="3" style="margin-left: 50px">
				<tr>
					<td>Tel. linka:</td>
					<td> <input type="text" name="tel_linka" style="width: 100px" /></td>
					<td>KM-typ, Komunikátor: </td>
					<td> <input type="text" name="km_typ_komunikator" style="width: 100px" /></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>GSM - typ: </td>
					<td> <input type="text" name="gsm_typ" style="width: 100px" /> </td>
					<td> Radio - typ: </td>
					<td> <input type="text" name="radio_typ" style="width: 100px" /> </td>
					<td> Iný typ - uviesť: </td>
					<td> <input type="text" name="iny_typ" style="width: 100px" /> </td>
				</tr>
			</table>
			Ochranu zabezpečuje: 
			<table border="0" cellpadding="0" cellspacing="3" style="margin-left: 50px" width="100%">
				<tr>
					<td>Štátna polícia: <input type="checkbox" name="statna_policia" value="t" /></td>
					<td>Mestská polícia: <input type="checkbox" name="mestska_policia"  value="t" /></td>
					<td>SBS <input type="checkbox" name="sbs_ch"  value="t" /> uviesť názov:  <input type="text" name="sbs" style="width: 120px" /></td>
				</tr>
			</table>
			
			<h3>Snímače</h3>
			 
			<table border="0" cellpadding="0" cellspacing="3">
				<tr>
					<td>Id</td>
					<td>Číslo f.</td>
					<td>Adresa</td>
					<td>Popis</td>
					<td>Typ snímača</td>
					<td align="center">Funkčnosť</td>
					<td align="center">Poloha</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="8">
						<div id="vysledky"></div>
					</td>
				</tr>
				<tr>
					<td><input name="idSnimac" id="idSnimac" type="text" value="" size="3" /></td>
					<td> <input name="cisloFormu" id="cisloFormu" type="text" value="" size="5" /></td>
					<td> <input name="adresaSnimac" id="adresaSnimac" type="text" value="" size="15" /></td>
					<td> <input name="popisSnimac" id="popisSnimac" type="text" value="" size="15" /></td>
					<td> <input name="typSnimac" id="typSnimac" type="text" value="" size="10" /></td>
					<td> <input type="radio" name="funkcnostSnimac" id="funkcnostSnimac" value="t" />funguje <input type="radio" name="funkcnostSnimac" id="funkcnostSnimac2" value="f" />nefunguje</td>
					<td> <input type="radio" name="polohaSnimac" id="polohaSnimac" value="t" />vyhovuje<input type="radio" name="polohaSnimac" id="polohaSnimac2" value="f" />nevyhovuje</td>
					<td> <input type="button" value="pridaj" size="20" onclick="prevedQuery_snimac(); clearLine('snimace');" /></td>
				</tr>
			</table>
			
			<h3>Sirény</h3>
			
			<table border="0" cellpadding="0" cellspacing="3">
				<tr>
					<td>Id</td>
					<td>Číslo formuláru</td>
					<td>Umiestnenie</td>
					<td>Typ-uviezť</td>
					<td align="center">Záloha</td>
					<td align="center">Funkčnosť</td>
				</tr>
				<tr>
					<td colspan="8">
						<div id="vysledky2"></div>
					</td>
				</tr>
				<tr>
					<td><input name="idSirena" id="idSirena" type="text" value="" size="3" /></td>
					<td> <input name="cisloSirena" id="cisloSirena" type="text" value="" size="15" /></td>
					<td> <input name="umiestnenieSirena" id="umiestnenieSirena" type="text" value="" size="15" /></td>
					<td> <input name="typSirena" id="typSirena" type="text" value="" size="10" /></td>
					<td> <input type="radio" name="zalohovanaSirena" id="zalohovanaSirena" value="t" />zálohovaná <input type="radio" name="zalohovanaSirena" id="zalohovanaSirena2" value="f" />nezálohovaná</td>
					<td> <input type="radio" name="funkcnostSirena" id="funkcnostSirena" value="t" />funguje <input type="radio" name="funkcnostSirena" id="funkcnostSirena2" value="t" />nefunguje</td>
					<td> <input type="button" value="pridaj" size="20" onclick="prevedQuery_sirena(); clearLine('sireny');" /></td>
				</tr>
			</table>
			<br />
			Inštalačné rozvody<br />
			<table border="0" cellpadding="0" cellspacing="3">
				<tr valign="top">
					<td>
						Pod omietkou:<br />
						<textarea name="rozvody_pod_omietkou" cols="30" rows="4"></textarea>
					</td>
					<td>
						PVC žľab:<br />
						<textarea name="rozvody_pvc_zlab" cols="30" rows="4"></textarea>
					</td>
					<td>
						Podhľad:<br />
						<textarea name="rozvody_podhlad" cols="30" rows="4"></textarea><br/>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					Iné:<br />	
					<textarea name="rozvody_ine" cols="97" rows="4"></textarea>
				</td>
				</tr>
				<tr valign="top">
					<td>
						Stav PSN (funkčná/nefunkčná):<br />
						<textarea name="stav_psn" cols="30" rows="7"></textarea>
					</td>
					<td>
						Závady:<br />
						<textarea name="zavady" cols="30" rows="7"></textarea>
					</td>
					<td>
						Poznámky:<br />
						<textarea name="poznamky" cols="30" rows="7"></textarea>		
					</td>
				</tr>
				
			</table><br />
			<script type="text/javascript">
				function checkForm(){
					var pov1 = document.getElementById('povinne1').value;
					var pov2 = document.getElementById('povinne2').value;
					if(pov1 == '' || pov2 == ''){
						alert('Nevyplnili ste povinné položky: TYP, Počet zón');
						return false;	
					}
					else 
						return true;
				}
			</script>
			<span style="font-weight:bold;color:red">ÚDAJE ZVÝRAZNENÉ ČERVENOU FARBOU A * SÚ POVINNÉ!</span><br />
			<input type="reset" value="Pôvodné údaje" /> <input type="submit" value="Odoslať údaje na sever"  
			onclick="return checkForm();" />
		</td>
	</tr>
</tbody>
</table>
</form>

</body>
