<?php
include 'utils/sql.php';
class UserModel{
  private $pdo = null;

  public function __construct(){
    $this->pdo = new SimplePdo();
  }

  public function getById($uid){
    $addStmt = $this->pdo->prepare(
      "select `password`, `key`, `role` from users where uid=?", "s", $uid);
    $addStmt->execute();
    $addStmt->store_result();
    $result = $addStmt->num_rows;
    $addStmt->bind_result($password, $key, $role);
    $addStmt->fetch();
    return array($password, $key, $role);
  }

  public function getMailById($uid){
    $addStmt = $this->pdo->prepare(
      "select `mail` from users where uid=?", "s", $uid);
    $addStmt->execute();
    $addStmt->store_result();
    $result = $addStmt->num_rows;
    $addStmt->bind_result($mail);
    $addStmt->fetch();
    return $mail;
  }

  public function getByMail($mail){
    $addStmt = $this->pdo->prepare(
      "select `uid`, `role` from users where mail=?", "s", $mail);
    $addStmt->execute();
    $addStmt->store_result();
    $result = $addStmt->num_rows;
    $addStmt->bind_result($uid, $role);
    $addStmt->fetch();
    return array($uid, $role);
  }

  public function add($uid, $password, $key){
    $addStmt = $this->pdo->prepare(
      "insert into users (uid, `password`, `key`) values (?, ?, ?)", "sss", $uid, $password, $key);
    $addStmt->execute();
    return $addStmt;
  }
  
  public function getAll(){
    return $this->pdo->query("select uid, mail, role from users");
  }
  
  public function delete($uid){
    $addStmt = $this->pdo->prepare("delete from users where uid=?", "s", $uid);
    $addStmt->execute();
  }

  public function update($role, $mail, $uid){
    $addStmt = $this->pdo->prepare("Update users set role=?, mail=? where uid=?", "sss", $role, $mail, $uid);
    $addStmt->execute();
    return $addStmt;
  }

  // public function updatePassByMail($pass, $key, $mail){
  //   $addStmt = $this->pdo->prepare("Update users set `password`=?, `key`=? where mail=?", "sss", $pass, $key, $mail);
  //   $addStmt->execute();
  //   // return $addStmt;
  // }

  public function updatePassById($pass, $key, $uid){
    $addStmt = $this->pdo->prepare("Update users set `password`=?, `key`=? where uid=?", "sss", $pass, $key, $uid);
    $addStmt->execute();
    // return $addStmt;
  }
}