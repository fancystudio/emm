<?php

class seo extends basic {
	var $sqlDB;				/* @var $sqlDB sql */	// sql connection object


  function setSEOUrl()
  {
    $path = strip_tags($_GET['path']);
    $this->sqlDB = new sql();
    $this->sqlDB->sql_connect();

    $sql = "  SELECT page_id
  			FROM page_path
  			WHERE path = '$path';
  			";

    if($path=='')
    {
      $_GET['pageId'] = 262;
      return;
    }

    $res = $this->sqlDB->sql_query($sql);
  	if($res==false) return false;

    if($this->sqlDB->sql_num_rows($res)>0)
    {
      $data = $this->sqlDB->sql_fetch_row($res);
      $_GET['pageId'] = $data[0];

      if ($_GET['pageId'] == 1) {
        $_GET['pageId']=262;
      }

      if ($_GET['pageId'] == 2) {
        $_GET['pageId']=263;
      }

    }
  	elseif ($path!="") $_GET['pathNotFound'] = 1;
  }
}
?>
