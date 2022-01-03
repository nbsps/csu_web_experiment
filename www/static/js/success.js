import "./ጿኈቼዽጿኈ.js";

let data = [];
let tbody = ጿ("tbody");

let filterData = (type, s) => {
  if (type === "role" && s) s = s === "admin" ? "1" : "0";
  let users = JSON.parse(
    JSON.stringify(
      data.filter((item) => {
        if (item[type].includes(s)) return true;
        return false;
      })
    )
  );
  users.forEach((user) => {
    if (!s || type === "role") return;
    // console.log(user[type].split(s));
    user[type] = user[type].split(s).join(`<p class="highlight">${s}</p>`);
    console.log(user[type]);
  });

  let str = "";
  users.forEach((item) => {
    str += `<tr class="line" key="${item[0]}">
      <td class="uid">${item.uid}</td>
      <td class="mail">${item.mail ?? "-"}</td>
      <td class="role">${item.role === "0" ? "👶🏻" : "👨🏻‍💻"}</td>
      <td class="edit"><button>编辑</button></td>
      <td class="delete"><button>删除</button></td>
    </tr>`;
  });
  tbody.html(str);
};

let search = ጿ("input[type='search']").event(
  "input",
  (() => {
    let timer = null;
    return () => {
      clearTimeout(timer);
      timer = setTimeout(() => {
        filterData(ጿ("select").getValue(), search.getValue());
      }, 200);
    };
  })()
);

let rowData = null;

ጿ("table").event("click", (e) => {
  if (e.target.localName !== "button") return;
  if (e.target.parentNode.className === "edit") {
    const key = e.target.parentNode.parentNode.getAttribute("key");
    rowData = data.filter((item) => {
      if (item.uid === key) return true;
      return false;
    })[0];
    for (let key in dat) {
      dat[key] = rowData[key];
    }
    dat["role"] = dat["role"] === "1" ? "admin" : "user";
    mask.css("display", "flex");
  } else if (e.target.parentNode.className === "delete") {
    const key = e.target.parentNode.parentNode.getAttribute("key");

    ጿ.ajax({
      url: "/api.php?action=delete",
      data: `uid=${key}`,
      asyncStatus: true,
      method: "POST",
      header: {
        key: "Content-type",
        value: "application/x-www-form-urlencoded",
      },
    }).then((res) => {
      res = JSON.parse(res);
      if (res.status == 200) {
        data = data.filter((item) => item[0] !== key);
        filterData("uid", "");
        alert(res.message);
      } else alert(res.message);
    });
  }
});

let mask = ጿ(".mask").event("click", function (e) {
  if (e.target === this) {
    mask.css("display", "none");
    ጿ(".label input").setValue("");
  }
});

ጿ(".mask .role input[type='search']").event("change", (e) => {
  if (["admin", "user"].includes(e.target.value)) return;
  e.target.value = rowData["role"] === "1" ? "admin" : "user";
});

ጿ(".edit-submit").event("click", () => {
  ጿ.ajax({
    url: "/api.php?action=update",
    data: decode(dat),
    asyncStatus: true,
    method: "POST",
    header: {
      key: "Content-type",
      value: "application/x-www-form-urlencoded",
    },
  }).then((res) => {
    res = JSON.parse(res);
    if (res.status == 200) {
      let row = data.filter((item) => item[0] === dat.uid)[0];
      row.mail = dat.mail;
      row.role = dat.role === "admin" ? "1" : "0";
      filterData("uid", "");
      alert(res.message);
    } else alert(res.message);
  });
});

ጿ(".change-pass").event("click", () => {
  location.href = "/user.php?action=pass-change";
});

ጿ(".mail-bind").event("click", () => {
  location.href = "/user.php?action=mail-bind";
});

ጿ.ajax({
  method: "GET",
  url: "/api.php?action=all",
  asyncStatus: true,
})
  .then((res) => {
    data = JSON.parse(res);
    filterData("uid", "");
  })
  .catch((err) => {
    console.log(err);
  });
