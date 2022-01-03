<?php

class SimplePDO{
  private $DB_SRV = "localhost";
  private $DB_USER = "root";
  private $DB_PWD = "root";
  private $DB_NAME = "user";
  private static $DB_CON = null;

  public function __construct(){
    $this->DB_CON = new mysqli($this->DB_SRV, $this->DB_USER, $this->DB_PWD, $this->DB_NAME);
    if(!$this->DB_CON) exit();
  }

  public function prepare($template, $format, ...$param){
    $stmt = $this->DB_CON->prepare($template);
    $stmt->bind_param($format, ...$param);
    return $stmt;
  }

  public function query($sql) {
    $result = $this->DB_CON->query($sql);
    $ret = [];
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $ret[] = $row;
        }
    }
    return $ret;
  }

}
// $pdo = new SimplePDO();
