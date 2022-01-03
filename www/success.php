<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>登录成功</title>
    <link rel="stylesheet" href="static/css/success.css" />
  </head>
  <body>
    <h1>
      登录成功🥤
      <?php 
      if($_SESSION['login'] && $_SESSION['role'] === 1){
        echo '<select>
        <option value="uid">uid</option>
        <option value="mail">mail</option>
        <option value="role">role</option>
      </select>
      <input type="search" id="search" />';
      } ?>
    </h1>
    <?php if($_SESSION['login'] && $_SESSION['role'] === 1){
      echo '<div class="wrapper">
      <table class="table">
        <thead class="line title" key="1">
          <tr>
            <th class="uid">uid</th>
            <th class="mail">邮箱地址</th>
            <th class="role">角色</th>
            <th class="edit">🛠</th>
            <th class="delete">⚔</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div class="mask" style="display: none">
      <div class="edit-panel">
        <h2>修改</h2>
        <h3>
          <div class="label">uid:</div>
          {{uid}}
        </h3>
        <h3 class="label mail">
          <div class="label">邮箱:</div>
          <input type="search" placeholder="{{mail}}" />
        </h3>
        <h3 class="label role">
          <div class="label">角色:</div>
          <input type="search" placeholder="{{role}}" />
        </h3>
        <button class="edit-submit">修改</button>
      </div>
    </div>
    <script src="static/js/vu3.js"></script>
    <script>
      var dat = {
        uid: "888",
        mail: "2467214168@qq.com",
        role: "admin",
      };
      new Vu3({
        el: ".mask",
        data: dat,
      });
    </script>';
    }else{
      echo "<h1>Welcome {$_SESSION['uid']}!</h1>";
    } ?>
    <div class="change-pass" title="修改密码">
      <img src="static/img/pass-change.svg" />
    </div>
    <div class="mail-bind" title="绑定邮箱">
      <img src="static/img/mail.svg" />
    </div>
    <script src="static/js/success.js" type="module"></script>
    
  </body>
</html>
