<?
   require('php-captcha.inc.php');
   $aFonts = array('fonts/VeraBd.ttf', 'fonts/VeraIt.ttf', 'fonts/Vera.ttf');
   $oPhpCaptcha = new PhpCaptcha($aFonts, 130, 40);
   $oPhpCaptcha->UseColour(true);
   $oPhpCaptcha->Create();
?>
                               
                               
