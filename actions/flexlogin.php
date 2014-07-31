<?php

define('WWW_ROOT', dirname(__FILE__).'/..');
define('APP_DIR', WWW_ROOT.'/include');

require(APP_DIR.'/core/template.php');
require(APP_DIR.'/core/form.php');
require(APP_DIR.'/core/XPM4/MAIL.php');

class ActionHandler
{
  private $address = '/';

  public function __construct()
  {
    session_set_cookie_params(0);
    session_cache_limiter('nocache');
    session_start();
  }

  public function Handle_register()
  {
    $form = new NetForm('flexlogin');

    if(!isset($_POST['pr_forma']))
    {
      $form->AddField('verzia', 5);
      $this->BeginDownload($form->verzia);

      die();
    }

    $form->AddField('pr_forma');

    if($form->pr_forma=='fo' || $form->pr_forma=='po')
    {
      if($form->pr_forma=='fo')
      {
        $form->AddField('meno', 50);
        $form->AddField('email', 50);
        $form->AddField('email_check', 50);
        $form->AddField('adresa', 50);
        $form->AddField('mesto', 50);
        $form->AddField('psc', 20);
        $form->AddField('stat', 50);
        $form->AddField('telefon', 50, false);
        $form->AddField('verzia', 5);
      }
      else
      {
        $form->AddField('nazov', 50);
        $form->AddField('email', 50);
        $form->AddField('email_check', 50);
        $form->AddField('adresa', 50);
        $form->AddField('mesto', 50);
        $form->AddField('psc', 20);
        $form->AddField('stat', 50);
        $form->AddField('ico', 20);
        $form->AddField('dic', 20);
        $form->AddField('ic_dph', 20, false);
        $form->AddField('penazny_ustav', 50, false);
        $form->AddField('cislo_uctu', 50, false);
        $form->AddField('telefon', 50, false);
        $form->AddField('verzia', 5);
      }

      if($form->IsComplete())
      {
        if($form->email==$form->email_check)
        {
          $template = new NetTemplate('email_flexlogin_'.$form->pr_forma);
          $template->form = $form;
          $email_text = $template->RenderToString();

          if($this->SendEmail('noreply@emm.sk', 'bedecs@emm.sk', 'EMMFlexLogin', $email_text))
          {
            $form->DestroyData();
            $this->BeginDownload($form->verzia);
          }
          else { $form->Save(); $this->SetRedirect('/sk/produkty-a-sluzby/sw-aplikacie/flexlogin/prevzatie/?status=failed'); }
        }
        else { $form->Save(); $this->SetRedirect('/sk/produkty-a-sluzby/sw-aplikacie/flexlogin/prevzatie/?status=email-missmatch'); }
      }
      else { $form->Save(); $this->SetRedirect('/sk/produkty-a-sluzby/sw-aplikacie/flexlogin/prevzatie/?status=empty-field'); }
    }
    else throw new Exception('internal error...');
  }

  private function SendEmail($from, $to, $subject, $message)
  {
    $mail = new MAIL;
    $mail->From('netropolis@netropolis.sk');
    $mail->AddTo($to);
    $mail->AddTo('flexlogin@emm.sk');
    $mail->Subject($subject, 'utf-8', 'base64');
    $mail->Text($message, 'utf-8', 'base64');

    $link = $mail->Connect('127.0.0.1', 25, '','');

    if($link)
    {
      if($mail->Send($link)) { $mail->Disconnect(); return true; }
      else { $mail->Disconnect(); return false; }
    }
    else return false;
  }

  private function BeginDownload($ver)
  {
    if($ver!='32' && $ver!='64' && $ver!='32_64') $ver = '32_64';
    $path = WWW_ROOT.'/downloads/flexlogin_'.$ver.'_h6w4f45rf8b.msi';

    if($fd = fopen($path, 'r'))
    {
      header('Content-type: application/octet-stream');
      header('Content-Disposition: filename="FlexLogin_Win'.$ver.'Setup.msi"');
      header('Content-length: '.filesize($path));

      while(!feof($fd)) echo fread($fd, 2048);
    }

    fclose ($fd);
    die();
  }

  public function SetRedirect($address)
  {
    $this->address = $address;
  }

  public function Redirect()
  {
    header('location: '. $this->address);
  }
};

try {
  $handler = new ActionHandler();
  $handler->Handle_register();
} catch(Exception $e) { die('Error: '.$e->getMessage()); }

$handler->Redirect();

?>