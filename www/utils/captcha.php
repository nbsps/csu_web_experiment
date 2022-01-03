<?php
  session_start();
  function rand_str($length) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for($i = 0; $i < $length; $i++){
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }
  function rand_color($image){
    return imagecolorallocate($image, rand(127, 255), rand(127, 255), rand(127, 255));
  }
  $image = imagecreate(200, 100);
  imagecolorallocate($image, 0, 0, 0);
  for ($i=0; $i <= 9; $i++) {
    imageline($image, rand(0, 200), rand(0, 100), rand(0, 200), rand(0, 100), rand_color($image));
  }
  for ($i=0; $i <= 100; $i++) {
    imagesetpixel($image, rand(0, 200), rand(0, 100), rand_color($image));
  }
  $length = 4;
  $str = rand_str($length);
  $font = 'C:\Windows\Fonts\ARIAL.ttf';
  // $font = "/var/www/html/static/font/ARIAL.TTF"; // docker中
  for ($i=0; $i < $length; $i++) {
    imagettftext($image, rand(20, 38), rand(0, 60), $i*50+25, rand(30,70), rand_color($image), $font, $str[$i]);
  }
  header('Content-type:image/jpeg');
  imagejpeg($image);
  imagedestroy($image);
  $_SESSION['captcha'] = $str;
?>