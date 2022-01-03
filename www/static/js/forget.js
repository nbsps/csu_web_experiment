import "./ጿኈቼዽጿኈ.js";

ጿ(".forget button").event("click", () => {
  const data = ጿ(".forget input").getValue();
  ጿ.ajax({
    url: "/api.php?action=forget",
    method: "POST",
    asyncState: true,
    data: decode({ data }),
    header: {
      key: "Content-type",
      value: "application/x-www-form-urlencoded",
    },
  }).then((res) => {
    res = JSON.parse(res);
    if (res.msg) alert(res.msg);
    else if (res.message) alert(res.message);
  });
});
