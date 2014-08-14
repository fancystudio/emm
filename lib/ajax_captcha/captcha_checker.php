<?php 
/********************************************************************************************************************
* This script is brought to you by Vasplus Programming Blog by whom all copyrights are reserved.
* Website: www.vasplus.info
* Email: info@vasplus.info
* Please, do not remove this information from the top of this page.
*********************************************************************************************************************/
include_once('../../lib/XPM2/smtp.php');
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
			$mailInfo .=  "Názov Firmy";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nazovFirmy'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Číslo Zmluvy";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['cisloZmluvy'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Nahlasovatel";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nahlasovatel'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Tel./Fax";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['telFax'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Email";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['email'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Typ Problému";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['typProblemu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Mozný Čas Zásahu";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['moznyCasZasahu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Názov/Typ";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['nazovTyp'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Výrobne Číslo";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['vyrobneCislo'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Dátum Dodania";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['datumDodania'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Verzia";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['verzia'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Produkt v Záruke";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['produktVZaruke'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Popis Problému";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['popisProblemuArea'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Adresa Produktu";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['adrsaProduktu'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
		$mailInfo .= "<tr>";
			$mailInfo .= "<td>";
			$mailInfo .=  "Priorita";
			$mailInfo .= "</td>";
			$mailInfo .= "<td>";
			$mailInfo .=  $_POST['priorita'];
			$mailInfo .= "</td>";
		$mailInfo .= "</tr>";
	$mailInfo .= "</table>";

	$mail = new SMTP;
	$from = "server@emm.sk";
	$mail->Delivery('relay');
	@$mail->Relay('mail.netropolis.sk', 'emm-smtp@office.netropolis.sk', 'kafj48zk214', 465, 'autodetect', 'ssl');
	@$mail->From($from);
	if($_POST['prijemca'] == "servis informačných systémov"){
		@$mail->AddTo("servisis@emm.sk");
	}elseif($_POST['prijemca'] == "BS, technickú bezpečnosť a dochádzkový a prístupový systém"){
		@$mail->AddTo("servisbs@emm.sk");
	}
	$mail->Html($mailInfo,"UTF-8");
	
	$sent = $mail->send("Servisny formular");	
	if($sent){
		echo '<div class="vpb_success" align="left">Captcha bola zadaná správne<br/>Žiadosť bola odoslaná</div>';
	}else{
		echo '<div class="vpb_success" align="left">Captcha bola zadaná správne<br/>Mail sa však nepodarilo odoslať</div>';
	}
}
?>