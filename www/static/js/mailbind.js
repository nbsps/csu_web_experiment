import "./ጿኈቼዽጿኈ.js";

ጿ(".get-code").event("click", () => {
  let mail = ጿ("#mail").getValue();
  let captcha = ጿ("#captcha").getValue();
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

ጿ(".submit").event("click", () => {
  let mail = ጿ("#mail").getValue();
  let code = ጿ("#code").getValue();
  // TODO: confirm
  ጿ.ajax({
    url: "/api.php?action=bindmail",
    method: "POST",
    asyncState: true,
    header: {
      key: "Content-type",
      value: "application/x-www-form-urlencoded",
    },
    data: decode({ mail, code }),
  }).then((res) => {
    res = JSON.parse(res);
    if (res.status) {
      alert(res.message);
      if (res.status == 200) location.href = "/success.php";
    }
  });
});

// ጿ(".forget button").event("click", () => {
//   const data = ጿ(".forget input").getValue();
//   ጿ.ajax({
//     url: "http://localhost/server/api.php?action=forget",
//     method: "POST",
//     asyncState: true,
//     data: decode({ data }),
//     header: {
//       key: "Content-type",
//       value: "application/x-www-form-urlencoded",
//     },
//   }).then((res) => {
//     res = JSON.parse(res);
//     // if (res.status == 200) location.href = "/server/success.php";
//     // else
//     alert(res.message);
//   });
// });
