<?php

class NetTemplate
{
  private $filename, $data = array();

  public function __construct($filename)
  {
    $this->filename = $filename;
  }

  public function __set($name, $value)
  {
    $this->data[$name] = $value;
  }

  public function Render()
  {
    foreach($this->data as $name => $value) $$name = $value;

    require(APP_DIR.'/templates/'.$this->filename.'.tpl.php');
  }

  public function RenderToString()
  {
    if(ob_start())
    {
      $this->Render();
      return ob_get_clean();
    } else return '';
  }
}

?>