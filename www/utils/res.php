<?php

function resMessage($code, $data, $msg){
  echo json_encode([
    'status' => $code,
    'data' => $data,
    'message' => $msg,
  ]);
}