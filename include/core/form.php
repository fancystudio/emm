<?php

class NetForm
{
  private $data = array(), $is_complete = true, $form_name;

  public function __construct($form_name = 'form')
  {
    $this->form_name = $form_name;
  }

  public function AddField($name, $length = 0, $requied = true)
  {
    $value = (isset($_POST[$name])) ? trim($_POST[$name]) : '';

    if(get_magic_quotes_gpc()) $value = stripslashes($value);

    if($length>0) $value = mb_substr($value, 0, $length, 'UTF-8');

    if($value!='') $this->data[$name] = $value;
    elseif($requied) $this->is_complete = false;
  }

  public function Save()
  {
    $this->DestroyData();
    
    $data = array();
    foreach($this->data as $name => $value) $data[$name] = $value;

    $_SESSION['forms'][$this->form_name] = $data;
  }

  public function Load()
  {
    if(isset($_SESSION['forms'][$this->form_name]))
    {
      $this->data = $_SESSION['forms'][$this->form_name];
      return true;
    }

    return false;
  }

  public function DestroyData()
  {
    if(isset($_SESSION['forms'][$this->form_name])) unset($_SESSION['forms'][$this->form_name]);
  }

  public function IsComplete()
  {
    return $this->is_complete;
  }

  public function HasMissingValue()
  {
    return !$this->is_complete;
  }

  public function HasField($name)
  {
    return isset($this->data[$name]);
  }

  public function SetData($data)
  {
    $this->data = $data;
  }

  public function HasData()
  {
    return (count($this->data)>0);
  }

  public function Get($name, $default = '')
  {
    return (isset($this->data[$name])) ? $this->data[$name] : $default;
  }

  public function __get($name)
  {
    return (isset($this->data[$name])) ? $this->data[$name] : '';
  }

  public function __set($name, $value)
  {
    $this->data[$name] = $value;
  }
};

?>