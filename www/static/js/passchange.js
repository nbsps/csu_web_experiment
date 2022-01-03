import "./ጿኈቼዽጿኈ.js";
import init, { encrypt } from "../wasm/pkg/wasm.js";

const passInput = ጿ("#pass");
const againInput = ጿ("#again");
const submit = ጿ(".submit");

const check = () => {
  const pass = passInput.getValue();
  const again = againInput.getValue();
  if (pass !== again || pass.length === 0)
    againInput.css("border", "2px solid red");
  else againInput.css("border", "2px solid blue");
};

passInput.event("input", check);
againInput.event("input", check);

submit.event("click", () => {
  let key = "";
  let pass = passInput.getValue();
  const again = againInput.getValue();
  let keycode = /key=(.*)/.exec(window.location.search);
  if (keycode.length > 0) keycode = keycode[1];
  if (pass.length === 0 || pass !== again) {
    alert("check your input!");
    againInput.css("border", "2px solid red");
    return;
  }
  init().then(() => {
    key = Array(4)
      .fill(0)
      .map(() => Math.random().toString(36).slice(-8))
      .join("");
    pass = encrypt(key, encrypt("", pass));
    ጿ.ajax({
      url: "/api.php?action=passchange",
      data: decode({ pass, keycode, key }),
      asyncStatus: true,
      method: "POST",
      header: {
        key: "Content-type",
        value: "application/x-www-form-urlencoded",
      },
    }).then((res) => {
      res = JSON.parse(res);
      if (res.status) {
        alert(res.message);
      } else {
        alert(res.msg);
        if (res.Code == 1) location.href = "/success.php";
      }
    });
  });
});
