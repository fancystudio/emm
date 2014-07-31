<?php 
/********************************************************************************************************************
* This script is brought to you by Vasplus Programming Blog by whom all copyrights are reserved.
* Website: www.vasplus.info
* Email: info@vasplus.info
* Please, do not remove this information from the top of this page.
*********************************************************************************************************************/
session_start();
if(empty($_SESSION['vpb_captcha_code']) || strcasecmp($_SESSION['vpb_captcha_code'], $_POST['vpb_captcha_code']) != 0)
{
	echo '<div class="vpb_info" align="left">Captcha bola zadaná nesprávne.</div>';
}
else
{
	$mailInfo = "<table>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "nazovFirmy";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nazovFirmy'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "cisloZmluvy";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['cisloZmluvy'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "nahlasovatel";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nahlasovatel'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "telFax";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['telFax'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "email";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['email'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "typProblemu";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['typProblemu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "moznyCasZasahu";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['moznyCasZasahu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "nazovTyp";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nazovTyp'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "vyrobneCislo";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['vyrobneCislo'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "datumDodania";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['datumDodania'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "verzia";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['verzia'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "produktVZaruke";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['produktVZaruke'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "popisProblemuArea";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['popisProblemuArea'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "adrsaProduktu";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['adrsaProduktu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "priorita";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['priorita'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "prijemca";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['prijemca'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
	$mailInfo .= "</table>";

	//mail("info@fancystudio.sk","test",$mailInfo,"From:info@fancystudio.sk \r\n") //dorobit na hostingu
	if(true){
		echo '<div class="vpb_success" align="left">Captcha bola zadaná správne<br/>Žiadosť bola odoslaná</div>';
	}else{
		echo '<div class="vpb_success" align="left">Captcha bola zadaná správne<br/>Mail sa však nepodarilo odoslať</div>';
	}
}
?>