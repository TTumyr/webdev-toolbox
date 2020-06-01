const nav = {
  btn: document.getElementById("navbar__icon"),
  navList: document.getElementById("navbar__menu"),
  btnClick() {
    if (
      this.navList.style.display === "none" ||
      this.navList.style.display === ""
    ) {
      this.navList.style.display = "block";
    } else {
      this.navList.style.display = "none";
    }
  },
  init() {
    this.setListener();
  },
  onResize() {
    if (window.innerWidth > 768) {
      this.navList.style.display = "block";
    } else if (window.innerWidth <= 768) {
      this.navList.style.display = "none";
    }
  },
  setListener() {
    this.btn.addEventListener("click", this.btnClick.bind(this));
    window.addEventListener("resize", this.onResize.bind(this));
  },
};

const userMini = {
  btn: document.getElementById("userMini"),
  menu: document.getElementById("userMini__menu"),
  btnClick() {
    if (this.menu.style.display === "none" || this.menu.style.display === "") {
      this.menu.style.display = "block";
    } else {
      this.menu.style.display = "none";
    }
  },
  init() {
    this.setListener();
  },
  setListener() {
    this.btn.addEventListener("click", this.btnClick.bind(this));
  },
};

const mainScript = {
  init() {
    nav.init();
    userMini.init();
  },
};

mainScript.init();
