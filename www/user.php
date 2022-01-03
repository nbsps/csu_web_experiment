<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$_SESSION['uid']; ?> |修改密码</title>
    <link rel="stylesheet" href="static/css/pass-change.css" />
  </head>
  <body>
    <header>
      <h2><?php if($_GET['action'] === "pass-change") echo "密码重置";
                else if($_GET['action'] === "mail-bind") echo "邮箱绑定";
                else header("Location: /index.php");?></h2>
      <h2><?=$_SESSION['uid']; ?> </h2>
    </header>
    <main>
      <?php 
        if($_GET['action'] === "pass-change"){
          if($_SESSION['login'] && !$_GET['key']) {
            $code = rand(100000, 999999);
            $_SESSION['forget'] = $_SESSION['mail'];
            $_SESSION['forget_key'] = $code;
            header("Location: /user.php?action=pass-change&key={$code}");
          }
          else if($_GET['key'] != $_SESSION['forget_key']) header("Location: /index.php");
          echo '<div class="pass-change">
          <label for="pass">新密码：</label>
          <input type="password" name="pass" id="pass" />
          <label for="pass">确认密码：</label>
          <input type="password" name="again" id="again" />
          <button class="submit">提交</button>
        </div>
        <script src="static/js/passchange.js" type="module"></script>';
        }else if($_GET['action'] === "mail-bind") {
          if(!$_SESSION['login']) header("Location: /index.php");
          echo '<div class="bind-mail">
          <label for="mail">
            绑定邮箱：
            <button class="get-code">验证码</button>
          </label>
          <input type="mail" name="mail" id="mail" />
          <label for="captcha">验证码：</label>
          <input type="text" name="captcha" id="captcha" />
          <img src="/utils/captcha.php">
          <label for="code">动态码：</label>
          <input type="text" name="code" id="code" />
          <button class="submit">提交</button>
        </div>
        <script src="static/js/mailbind.js" type="module"></script>';
        }
      ?>
    </main>
    
  </body>
</html>
