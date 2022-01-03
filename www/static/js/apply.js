import "./ጿኈቼዽጿኈ.js";
import init, { encrypt } from "../wasm/pkg/wasm.js";

const uidInput = ጿ("#uid");
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
uidInput.event("input", () => {
  if (!uidInput.getValue()) uidInput.css("border", "2px solid red");
  else uidInput.css("border", "1px solid black");
});

submit.event("click", () => {
  const uid = uidInput.getValue();
  let pass = passInput.getValue();
  const again = againInput.getValue();
  let key = "";
  if (uid.length === 0) {
    alert("Plz check your UID!");
    uidInput.css("border", "2px solid red");
    return;
  }
  if (pass.length === 0 || pass !== again) {
    alert("Plz check your pass or pass-twice input!");
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
      url: "/api.php?action=apply",
      data: decode({ uid, pass, key }),
      asyncStatus: true,
      method: "POST",
      header: {
        key: "Content-type",
        value: "application/x-www-form-urlencoded",
      },
    }).then((res) => {
      res = JSON.parse(res);
      if (res.status) alert(res.message);
    });
  });
});
