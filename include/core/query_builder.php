<?php

class QueryBuilder
{
  private $data = array();

  public function AddString($name, $value, $length = 0, $default = '')
  {
    if($length>0) $value = mb_substr($value, 0, $length, 'UTF-8');
    if($value=='') $value = $default;

    if($value!='NULL') $this->data[$name] = "'".NetDB::EscapeString($value)."'";
  }

  public function AddSql($name, $value)
  {
    $this->data[$name] = $value;
  }

  public function AddInteger($name, $value, $min = 0)
  {
    $value = (integer) $value;
    if($value<$min) $value = $min;

    $this->data[$name] = $value;
  }

  public function AddFloat($name, $value, $min = 0.0)
  {
    $value = (float) $value;
    if($value<$min) $value = $min;

    $this->data[$name] = $value;
  }

  public function AddBoolean($name, $value)
  {
    $this->data[$name] = ($value) ? 'TRUE' : 'FALSE';
  }

  public function GetInsertQuery($table)
  {
    $query = 'INSERT INTO '.$table;

    $fields = array_keys($this->data);
    $query .= ' ('.implode(',', $fields).') VALUES (';
    $query .= implode(',', $this->data).');';

    return $query;
  }

  public function GetUpdateQuery($table, $id, $id_field = 'id')
  {
    $query = 'UPDATE '.$table.' SET '.$id_field.'='.$id;

    foreach($this->data as $name => $value) $query .= ','.$name.'='.$value;

    $query .= ' WHERE '.$id_field.'='.$id.';';

    return $query;
  }
}

?>