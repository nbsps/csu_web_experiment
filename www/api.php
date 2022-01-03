<?php
session_start();
include 'controller/controller.php';
include 'utils/res.php';

header("Access-Control-Allow-Origin: *");

// 全局事件处理
// api 请求分发
try{
  switch($_GET['action']){
    case 'login':
      login();break;
    case 'getcode':
      getcode();break;
    case 'verify':
      verify();break;
    case 'all':
      getAll();break;
    case 'delete':
      delete();break;
    case 'update':
      update();break;
    case 'forget':
      forget();break;
    case 'passchange':
      passchange();break;
    case 'bindmail':
      bindmail();break;
    case 'apply':
      apply();break;
  }
}catch(Exception $e){
  resMessage(500, null, $e->getMessage());
  // var_dump($e);
}
