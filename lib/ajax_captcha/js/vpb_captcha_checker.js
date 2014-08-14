/********************************************************************************************************************
* This script is brought to you by Vasplus Programming Blog by whom all copyrights are reserved.
* Website: www.vasplus.info
* Email: info@vasplus.info
* Please, do not remove this information from the top of this page.
*********************************************************************************************************************/


//This function refreshes the security or captcha code when clicked on the refresh link
function vpb_refresh_aptcha()
{
	$(".fakeContent #captchaimg,.containerHorizontal #captchaimg").removeAttr( "src" );
	return $(".fakeContent #vpb_captcha_code,.containerHorizontal #vpb_captcha_code").val('').focus(),$(".fakeContent #captchaimg,.containerHorizontal #captchaimg").attr("src","lib/ajax_captcha/vasplusCaptcha.php" + "?rand="+Math.random()*1000);
}



//This function checks to see if the code provided is correct or wrong and displays the appropriate result on the screen to the user
function vpb_submit_captcha()
{
	var vpb_captcha_code = (($(".fakeContent #vpb_captcha_code").val() != "" && $(".fakeContent #vpb_captcha_code").val() != undefined) ? $(".fakeContent #vpb_captcha_code").val() : $(".containerHorizontal #vpb_captcha_code").val());
	if(vpb_captcha_code == "")
	{
		$(".fakeContent #captchaResponse,.containerHorizontal #captchaResponse").html('<div class="vpb_info" align="left">Prosím vyplnte captchu.</div>');
		$(".fakeContent #vpb_captcha_code,.containerHorizontal #vpb_captcha_code").focus();
	}
	else
	{	
		var dataString = 'vpb_captcha_code='+ vpb_captcha_code;
		$.ajax({
			type: "POST",
			url: "lib/ajax_captcha/captcha_checker.php",
			data: {
				vpb_captcha_code : vpb_captcha_code,
				nazovFirmy : (($(".fakeContent .nazovFirmy").val() != "" && $(".fakeContent .nazovFirmy").val() != undefined) ? $(".fakeContent .nazovFirmy").val() : $(".containerHorizontal .nazovFirmy").val()),
				cisloZmluvy : (($(".fakeContent .cisloZmluvy").val() != "" && $(".fakeContent .cisloZmluvy").val() != undefined) ? $(".fakeContent .cisloZmluvy").val() : $(".containerHorizontal .cisloZmluvy").val()),
				nahlasovatel : (($(".fakeContent .nahlasovatel").val() != "" && $(".fakeContent .nahlasovatel").val() != undefined) ? $(".fakeContent .nahlasovatel").val() : $(".containerHorizontal .nahlasovatel").val()),
				telFax : (($(".fakeContent .telFax").val() != "" && $(".fakeContent .telFax").val() != undefined) ? $(".fakeContent .telFax").val() : $(".containerHorizontal .telFax").val()),
				email : (($(".fakeContent .email").val() != "" && $(".fakeContent .email").val() != undefined) ? $(".fakeContent .email").val() : $(".containerHorizontal .email").val()),
				typProblemu : (($(".fakeContent .typProblemu").val() != "" && $(".fakeContent .typProblemu").val() != undefined) ? $(".fakeContent .typProblemu").val() : $(".containerHorizontal .typProblemu").val()),
				moznyCasZasahu : (($(".fakeContent .moznyCasZasahu").val() != "" && $(".fakeContent .moznyCasZasahu").val() != undefined) ? $(".fakeContent .moznyCasZasahu").val() : $(".containerHorizontal .moznyCasZasahu").val()),
				nazovTyp : (($(".fakeContent .nazovTyp").val() != "" && $(".fakeContent .nazovTyp").val() != undefined) ? $(".fakeContent .nazovTyp").val() : $(".containerHorizontal .nazovTyp").val()),
				vyrobneCislo : (($(".fakeContent .vyrobneCislo").val() != "" && $(".fakeContent .vyrobneCislo").val() != undefined) ? $(".fakeContent .vyrobneCislo").val() : $(".containerHorizontal .vyrobneCislo").val()),
				datumDodania : (($(".fakeContent .datumDodania").val() != "" && $(".fakeContent .datumDodania").val() != undefined) ? $(".fakeContent .datumDodania").val() : $(".containerHorizontal .datumDodania").val()),
				verzia : (($(".fakeContent .verzia").val() != "" && $(".fakeContent .verzia").val() != undefined) ? $(".fakeContent .verzia").val() : $(".containerHorizontal .verzia").val()),
				produktVZaruke : (($(".fakeContent .produktVZaruke").val() != "" && $(".fakeContent .produktVZaruke").val() != undefined) ? $(".fakeContent .produktVZaruke").val() : $(".containerHorizontal .produktVZaruke").val()),
				adrsaProduktu : (($(".fakeContent .adrsaProduktu").val() != "" && $(".fakeContent .adrsaProduktu").val() != undefined) ? $(".fakeContent .adrsaProduktu").val() : $(".containerHorizontal .adrsaProduktu").val()),
				popisProblemuArea : (($(".fakeContent .popisProblemuArea").val() != "" && $(".fakeContent .popisProblemuArea").val() != undefined) ? $(".fakeContent .popisProblemuArea").val() : $(".containerHorizontal .popisProblemuArea").val()),
				priorita : (($(".fakeContent .priorita").val() != "" && $(".fakeContent .priorita").val() != undefined) ? $(".fakeContent .priorita").val() : $(".containerHorizontal .priorita").val()),
				prijemca : (($(".fakeContent .prijemca").val() != "" && $(".fakeContent .prijemca").val() != undefined) ? $(".fakeContent .prijemca").val() : $(".containerHorizontal .prijemca").val())
			},
			cache: false,
			beforeSend: function() 
			{
				//$(".fakeContent #captchaResponse,.containerHorizontal #captchaResponse").html('<div style="padding-left:100px;margin-bottom:30px;"></div>');
			},
			success: function(response)
			{
				vpb_refresh_aptcha(); //Refresh the Captcha Image on success or on wrong security submitted
				$(".fakeContent #vpb_captcha_code,.containerHorizontal #vpb_captcha_code").val('');
				$(".fakeContent #captchaResponse,.containerHorizontal #captchaResponse").hide().fadeIn('slow').html(response);
				$(".fakeContent #submitOrder, .containerHorizontal #submitOrder").removeAttr("onclick");
			}
		});
	}
}