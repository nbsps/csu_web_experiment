<?php
include 'model/model.php';

function login(){
  $usermodel = new UserModel();
  $uid = $_POST['uid'];
  $pass = $_POST['pass'];
  if(!$uid) throw(new Exception("Uid error!"));
  if(strlen($pass) !== 32) throw(new Exception("Pass error!"));
  list ($password, $key, $role) = $usermodel->getById($uid);
  if(!$password) throw(new Exception("User not Exists!"));
  for($i=0; $i < 32; $i++){
    if((ord($pass[$i]) ^ ord($key[$i])) % 26 + 97 !== ord($password[$i])) throw(new Exception("Pass error!"));
  }
  $_SESSION['login'] = true;
  $_SESSION['role'] = $role;
  $_SESSION['uid'] = $uid;
  resMessage(200, null, "Verified!");
}

function getcode(){
  $usermodel = new UserModel();
  $mail = $_POST['mail'];
  $captcha = $_POST['captcha'];
  if(!$mail) throw(new Exception("Plz give mail Address!"));
  if($captcha !== $_SESSION['captcha']) throw(new Exception("Captche error!"));
  list ($uid, $role) = $usermodel->getByMail($mail);
  if(!$_SESSION['login'] && !$uid) throw(new Exception("Plz bind mail first!"));
  include 'utils/EmailSender.php';
  $send = new EmailSender();
  $code =  rand(100000, 999999);
  $url = "{$send->url}&name=验证码&certno=尊敬的客户您好。您本次的验证码为：{$code}&address=${mail}";
  echo $send->sendCurlPost($url);
  $_SESSION['code'] = $code;
  $_SESSION['code_mail'] = $mail;
}


function verify(){
  $usermodel = new UserModel();
  $mail = $_POST['mail'];
  $code = $_POST['code'];
  if($mail !== $_SESSION['code_mail']) throw(new Exception("Code not for this Mail!"));
  if($code != $_SESSION['code']) throw(new Exception("Verify code error!"));
  list ($uid, $role) = $usermodel->getByMail($mail);
  // if(!$uid) throw(new Exception("Mail address error!"));
  $_SESSION['login'] = true;
  $_SESSION['role'] = $role;
  $_SESSION['uid'] = $uid;
  resMessage(200, null, "Verified!");
}

function getAll(){
  $usermodel = new UserModel();
  $users = $usermodel->getAll();
  echo json_encode($users);
}

function delete(){
  $usermodel = new UserModel();
  $uid = $_POST['uid'];
  $usermodel->delete($uid);
  resMessage(200, null, "Affected (1)rows!");
}

function update(){
  $usermodel = new UserModel();
  $uid = $_POST['uid'];
  $role = $_POST['role'] === "admin" ? "1" : "0";
  $mail = $_POST['mail'];
  $usermodel->update($role, $mail, $uid);
  resMessage(200, null, "Affected (1)rows!");
}

function forget(){
  include "utils/EmailSender.php";
  $mail = null;
  $usermodel = new UserModel();
  $data = $_POST['data'];
  list ($uid, $role) = $usermodel->getByMail($data);
  if($uid) {
    $mail = $data;
  } else{
    $uid = $data;
    $mail = $usermodel->getMailById($data);
  }
  if(!$mail) throw(new Exception("Input Error(not exist)!"));
  $send = new EmailSender();
  $code =  rand(100000, 999999);
  // VM上：改成ip或自己域名+port
  // $url = "{$send->url}&name=重置密码&certno=您好。请前往此链接重置密码：http%3a%2f%2fwww.nbsps.top:11111%2fuser.php%3faction%3dpass-change%26key%3d{$code}&address=${mail}";
  $url = "{$send->url}&name=重置密码&certno=您好。请前往此链接重置密码：http%3a%2f%2flocalhost%2fuser.php%3faction%3dpass-change%26key%3d{$code}&address=${mail}";
  echo $send->sendCurlPost($url);
  $_SESSION['uid'] = $uid;
  $_SESSION['forget'] = $mail;
  $_SESSION['forget_key'] = $code;
}

function passchange(){
  include "utils/EmailSender.php";
  // $mail = $_SESSION['forget'];
  // if(!$mail) throw(new Exception("Not Allowed!"));
  $usermodel = new UserModel();
  $pass = $_POST['pass'];
  $keycode = $_POST['keycode'];
  $key = $_POST['key'];
  if($keycode != $_SESSION['forget_key']) throw(new Exception("Not Allowed!"));
  // list ($uid, $role) = $usermodel->getByMail($mail);
  // if(!$uid) throw(new Exception("Mail Address not Exists"));
  // if(!$mail && !$_SESSION['uid'])  
  // if($mail) {
  //   $usermodel->updatePassByMail($pass, $key, $mail);
  //   $send = new EmailSender();
  //   $url = "{$send->url}&name=重置密码成功&certno=您好。重置密码成功！&address=${mail}";
  //   $send->sendCurlPost($url);
  // }else {
  if(strlen($pass) !== 32 || strlen($key) !== 32) throw(new Exception("Key or Password went wrong!"));
  $usermodel->updatePassById($pass, $key, $_SESSION['uid']);
  $mail = $usermodel->getMailById($_SESSION['uid']);
  if($mail) {
    $send = new EmailSender();
    $url = "{$send->url}&name=重置密码成功&certno=您好。重置密码成功！&address=${mail}";
    echo $send->sendCurlPost($url);
  }else{
    resMessage(200, null, "Password Changed!");
  }
  // }
}

function bindmail(){
  $usermodel = new UserModel();
  $mail = $_POST['mail'];
  $code = $_POST['code'];
  if($mail !== $_SESSION['code_mail']) throw(new Exception("Code not for this Mail!"));
  if($code != $_SESSION['code']) throw(new Exception("Code Error!"));
  // list ($uid, $role) = $usermodel->getByMail($mail);
  // if(!$uid) throw(new Exception("Mail address error!"));
  $usermodel->update($_SESSION['role'], $mail, $_SESSION['uid']);
  resMessage(200, null, "Mail binded!");
}

function apply(){
  $usermodel = new UserModel();
  $uid = $_POST['uid'];
  $pass = $_POST['pass'];
  $key = $_POST['key'];
  if(!$uid || strlen($pass) !== 32 || strlen($key) !== 32) throw(new Exception("Input Wrong!"));
  list ($_, $__, $___) = $usermodel->getById($uid);
  if($_) throw(new Exception("The UID existed"));
  $usermodel->add($uid, $pass, $key);
  // if($result->error_list.length > 0) throw(new Exception());
  resMessage(200, null, "User ".$uid." added!");
}

