// ጿ ኈ ቼ ዽ ጿ ኈ

class ጿኈቼዽጿኈ {
  elements = null;
  static baseURL = "";

  constructor(selector) {
    this.elements = Array.from(document.querySelectorAll(selector));
  }

  getValue() {
    console.log(this);
    return this.elements[0].value;
  }

  setValue(v) {
    for (let item of this.elements) {
      item.value = v;
    }
  }

  cls(s) {
    for (let item of this.elements) {
      item.className = s;
    }
    return this;
  }

  // hasAttr(attr) {
  //   return this.elements.every((item) => item.hasAttribute(attr));
  // }

  event(type, fn) {
    for (let item of this.elements) {
      item.addEventListener(type, fn);
    }
    return this;
  }

  css(key, value) {
    if (!key || !(typeof key === "string")) return this;
    for (let item of this.elements) {
      item.style[key] = value;
    }
    return this;
  }

  html(html_str) {
    // if (!html_str) {
    //   let e_html = [];
    //   for (let item of this.elements) {
    //     e_html.push(item.innerHTML);
    //   }
    //   return e_html;
    // }
    for (let item of this.elements) {
      item.innerHTML = html_str;
    }
    return this;
  }

  text(text) {
    if (!text) {
      let e_text = [];
      for (let item of this.elements) {
        e_text.push(item.innerHTML);
      }
      return e_text;
    }
    for (let item of this.elements) {
      item.innerText = text;
    }
    return this;
  }

  static ajax({ method, url, data, asyncState, header }) {
    let message = data ?? null;
    let xhr = null;
    url = this.baseURL + url;
    if (XMLHttpRequest) xhr = new XMLHttpRequest();
    else xhr = new ActiveXObject("Microsoft.XMLHTTP");

    return new Promise(function (resolve, reject) {
      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
          resolve(xhr.responseText);
        } else if (xhr.readyState == 4) {
          reject(xhr);
        }
      };
      xhr.open(method, url, asyncState);
      if (header) xhr.setRequestHeader(header.key, header.value);
      xhr.send(message);
    });
  }
}

window.ጿ = (selector) => {
  return new ጿኈቼዽጿኈ(selector);
};
ጿ.__proto__ = ጿኈቼዽጿኈ;

window.decode = (data) => {
  let post = [];
  for (let i in data) {
    post.push(`${i}=${data[i]}`);
  }
  return encodeURI(post.join("&"));
};
