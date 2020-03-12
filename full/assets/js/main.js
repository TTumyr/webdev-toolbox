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
  init() {
    this.setListener();
  }
};
nav.init();
