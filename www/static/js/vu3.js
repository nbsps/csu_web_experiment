class Dep {
  static target;

  constructor() {
    this.subs = [];
  }

  addSub() {
    this.subs.push(Dep.target);
  }

  notify() {
    this.subs.forEach((sub) => sub.update());
  }
}

class Watch {
  constructor(node, name, data) {
    this.node = node;
    this.name = name;
    this.data = data;
    Dep.target = this;
    this.update();
    Dep.target = null;
  }

  update() {
    this.node.nodeValue = this.data[this.name];
  }
}

class Vu3 {
  constructor({ el, data }) {
    this.reg = /\{\{(.+)\}\}/;
    this.data = data;
    for (let key in data) {
      let value = data[key];
      const dep = new Dep();
      Object.defineProperty(data, key, {
        get() {
          if (Dep.target) {
            dep.addSub();
          }
          return value;
        },
        set(v) {
          if (value === v) return;
          value = v;
          dep.notify();
        },
      });
    }
    this.el = document.querySelector(el);
    this.compile(this.el);
  }

  compile(node) {
    let children = node.childNodes;
    for (let child of children) {
      if (child.nodeType == 3) {
        if (this.reg.test(child.nodeValue)) {
          const name = RegExp.$1.trim();
          new Watch(child, name, this.data);
        }
      } else if (child.nodeType == 1) {
        const attributes = child.attributes;
        for (let attr of attributes) {
          if (this.reg.test(attr.nodeValue)) {
            const name = RegExp.$1.trim();
            new Watch(attr, name, this.data);
            child.addEventListener("input", (e) => {
              this.data[name] = e.target.value;
            });
          }
        }
      }
      if (child.childNodes) this.compile(child);
    }
  }
}
