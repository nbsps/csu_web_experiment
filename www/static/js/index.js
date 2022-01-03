import init, { encrypt } from "../wasm/pkg/wasm.js";

const dotlist = document.querySelectorAll(".dot");
const imglist = document.querySelector(".imglist");
let timer;
let currentOffset = 1;
dotlist.forEach((dotitem, i) => {
  dotitem.addEventListener("click", function () {
    imglist.style.left = `calc(-100% * ${i + 1})`;
    dotlist.forEach((item) => (item.className = "dot"));
    this.className = "dot active";
    currentOffset = (i + 1) % 6;
  });
});
const autoSwipper = (time) => {
  return setTimeout(() => {
    imglist.style.transition = "all 1s ease-in-out";
    if (currentOffset == 0) imglist.style.transition = "all 0s ease";
    imglist.style.left = `calc(-100% * ${currentOffset + 1})`;
    dotlist.forEach((item) => (item.className = "dot"));
    dotlist[currentOffset % 5].className = "dot active";
    currentOffset = (currentOffset + 1) % 6;
    if (currentOffset == 0) {
      autoSwipper(1000);
      autoSwipper(2000);
      return;
    }
    if (currentOffset == 1) return;
    timer = autoSwipper(2000);
  }, time);
};
timer = autoSwipper(2000);
const uplogin = document.getElementById("uplogin");
const codelogin = document.getElementById("codelogin");
const namepass = document.querySelector(".namepass");
const mailcode = document.querySelector(".mailcode");
uplogin.addEventListener("click", () => {
  uplogin.className = "active";
  codelogin.className = "";
  mailcode.style["display"] = "none";
  namepass.style["display"] = "block";
});
codelogin.addEventListener("click", () => {
  uplogin.className = "";
  codelogin.className = "active";
  mailcode.style["display"] = "block";
  namepass.style["display"] = "none";
});
const i18nDic = {
  zh_CN: {
    accountPass: "账号登录",
    codeLogin: "状态码登录",
    uidInput: "请输入学号",
    passInput: "请输入密码",
    free7: "7天免登录",
    login: "登录",
    forgetPass: "忘记密码",
    getAccount: "账号注册",
    mailInput: "请输入邮箱地址",
    captcheInput: "请输入验证码",
    codeInput: "请输入动态码",
    getCode: "获取动态码",
  },
  en: {
    accountPass: "Account login",
    codeLogin: "Dynamic Code login",
    uidInput: "Enter student ID",
    passInput: "Enter password",
    free7: "7 day free",
    login: "Login",
    forgetPass: "Forget password",
    getAccount: "Account activation",
    mailInput: "Enter mail address",
    captcheInput: "Enter verification code",
    codeInput: "Enter Dynamic Code",
    getCode: "Obtain",
  },
};

let i18n = JSON.parse(JSON.stringify(i18nDic.zh_CN));

new Vu3({
  el: ".wrap",
  data: i18n,
});

ጿ("select").event("change", (e) => {
  for (let item in i18n) {
    i18n[item] = i18nDic[e.target.value][item];
  }
});

let uid = ጿ(".username input");
let pass = ጿ(".password input");
if (localStorage.getItem("uid")) uid.setValue(localStorage.getItem("uid"));
if (localStorage.getItem("pass")) pass.setValue(localStorage.getItem("pass"));

// 账号密码登录
ጿ(".upsubmit").event("click", () => {
  let uid = ጿ(".username input").getValue();
  let pass = ጿ(".password input").getValue();
  if (!uid || !pass) {
    alert("Plz give all data!");
    return;
  }
  init().then(() => {
    let free7 = document.querySelector(".remember-me input").checked;
    if (free7) {
      localStorage.setItem("uid", uid);
      localStorage.setItem("pass", pass);
    }
    pass = encrypt("", pass);
    ጿ.ajax({
      url: "/api.php?action=login",
      method: "POST",
      asyncState: true,
      header: {
        key: "Content-type",
        value: "application/x-www-form-urlencoded",
      },
      data: decode({ uid, pass }),
    }).then((res) => {
      res = JSON.parse(res);
      if (res.status == 200) location.href = "/success.php";
      else alert(res.message);
    });
  });
});

ጿ(".getcode").event("click", () => {
  let mail = ጿ(".mail-address input").getValue();
  let captcha = ጿ(".captcha input").getValue();
  if (!mail || !captcha) {
    alert("Plz give all data!");
    return;
  }
  ጿ.ajax({
    url: "/api.php?action=getcode",
    asyncState: true,
    method: "POST",
    data: decode({ mail, captcha }),
    header: {
      key: "Content-type",
      value: "application/x-www-form-urlencoded",
    },
  }).then((res) => {
    res = JSON.parse(res);
    if (res.status == 500) {
      alert(res.message);
    } else {
      alert(res.msg);
    }
  });
});

// code 登录
ጿ(".mailsubmit").event("click", () => {
  let mail = ጿ(".mail-address input").getValue();
  let code = ጿ(".code input").getValue();
  if (!mail || !code) {
    alert("Plz give all data!");
    return;
  }
  ጿ.ajax({
    url: "/api.php?action=verify",
    method: "POST",
    asyncState: true,
    header: {
      key: "Content-type",
      value: "application/x-www-form-urlencoded",
    },
    data: decode({ mail, code }),
  }).then((res) => {
    res = JSON.parse(res);
    if (res.status == 200) location.href = "/success.php";
    else alert(res.message);
  });
});

ጿ(".forget").event("click", () => {
  location.href = "/forget.php";
});

ጿ(".apply").event("click", () => {
  location.href = "/apply.php";
});
