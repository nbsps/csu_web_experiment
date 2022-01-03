<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>统一身份认证平台</title>
    <link rel="stylesheet" href="static/css/index.css" />
  </head>
  <body>
    <div class="logo">
      <img src="static/img/logo.png" alt="logo" />
      <span>统一身份认证</span>
    </div>
    <div class="carousel">
      <div class="imglist">
        <div><img src="static/img/pic5.png" alt="pic5" /></div>
        <div><img src="static/img/pic1.png" alt="pic1" /></div>
        <div><img src="static/img/pic2.png" alt="pic2" /></div>
        <div><img src="static/img/pic3.png" alt="pic3" /></div>
        <div><img src="static/img/pic4.png" alt="pic4" /></div>
        <div><img src="static/img/pic5.png" alt="pic5" /></div>
        <div><img src="static/img/pic1.png" alt="pic1" /></div>
      </div>
      <div class="dotlist">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>
    <div class="wrap">
      <div class="login-wrapper">
        <div class="login">
          <div class="breadthumb">
            <span id="uplogin" class="active">{{accountPass}}</span>
            <span id="codelogin">{{codeLogin}}</span>
          </div>
          <div class="namepass">
            <div class="username">
              <img src="static/img/user.png" />
              <input type="text" placeholder="{{uidInput}}" />
            </div>
            <div class="password">
              <img src="static/img/pass.png" />
              <input type="password" placeholder="{{passInput}}" />
            </div>
            <div class="remember-me">
              <input type="checkbox" id="remember" />
              <span>{{free7}}</span>
            </div>
            <button class="upsubmit">{{login}}</button>
            <a class="forget">{{forgetPass}}</a>
            <a class="apply">{{getAccount}}</a>
          </div>
          <div class="mailcode">
            <div class="mail-address">
              <img src="static/img/user.png" />
              <input type="text" placeholder="{{mailInput}}" />
            </div>
            <div class="captcha">
              <img src="static/img/captcha.png" />
              <input type="text" placeholder="{{captcheInput}}" />
              <img
                src="/utils/captcha.php"
                class="img-captche"
              />
            </div>
            <div class="code">
              <img src="static/img/code.png" />
              <input type="text" placeholder="{{codeInput}}" />
              <button class="getcode">{{getCode}}</button>
            </div>
            <button class="mailsubmit">{{login}}</button>
            <a class="forget">{{forgetPass}}</a>
            <a class="apply">{{getAccount}}</a>
          </div>
        </div>
      </div>
    </div>
    <select class="t_switch_list">
      <option value="zh_CN">简体中文</option>
      <option value="en">English</option>
    </select>
    <script src="static/js/ጿኈቼዽጿኈ.js"></script>
    <script src="static/js/vu3.js"></script>
    <script src="static/js/index.js" type="module"></script>
  </body>
</html>
