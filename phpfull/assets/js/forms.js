const regFrm = {
  form: document.getElementById("regform"),
  // form fields
  fields: {
    csrf: document.getElementById("csrf"),
    username: document.getElementById("username"),
    email: document.getElementById("email"),
    password: document.getElementById("password"),
    regSubmit: document.getElementById("regsubmit"),
  },
  url: {
    user: "http://localhost/json/client/validate",
    email: "http://localhost/json/client/validate",
    register: "http://localhost/register",
  },
  limits: {
    userMin: 4,
    userMax: 30,
    pwMin: 3,
    pwMax: 255,
  },
  readyStatus: {
    username: false,
    email: false,
    password: false,
  },
  addEventListeners() {
    ["submit", "input", "change"].forEach((listen) => {
      this.form.addEventListener(listen, this.eventHandler.bind(this, this));
    });
  },
  checkEmail(el) {
    this.removeInput(el);
    const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (emailReg.test(el.value.trim())) {
      return true;
    } else {
      this.showError(el, "Email is not valid");
    }
  },
  checkIfExists(e, fetchUrl, username, email) {
    // variables for the fetch
    let formField = "";
    const fetchObject = {
      csrf: this.fields.csrf.value,
    };
    if (username) fetchObject["username"] = username;
    if (email) fetchObject["email"] = email;
    if (username) formField = "username";
    if (email) formField = "email";

    fetch(fetchUrl, {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify(fetchObject),
    })
      .then((response) => response.json())
      .then((resData) => {
        if (
          resData.length !== 0 &&
          resData !== undefined &&
          e.target.value === resData[0][formField]
        ) {
          this.showError(
            e.target,
            `${username ? "Username" : "Email address"} is not available`
          );
        } else {
          this.showSuccess(e.target);
        }
      });
  },
  checkLength(el, min, max) {
    this.removeInput(el);
    if (el.value.length < min) {
      this.showError(el, `${el.name} must be at least ${min} characters`);
    } else if (el.value.length > max) {
      this.showError(el, `${el.name} must be less than ${max} characters`);
    } else {
      return true;
    }
  },
  checkPassword(el) {
    this.removeInput(el);
    if (
      this.checkLength(
        this.fields.password,
        this.limits.pwMin,
        this.limits.pwMax
      )
    ) {
      this.showSuccess(el);
    }
  },
  eventContent(el, e) {
    switch (e.target.name) {
      case "username":
        {
          if (e.target.value !== "") {
            //checks if username meets requiremenets
            if (
              this.checkLength(
                el.fields.username,
                this.limits.userMin,
                this.limits.userMax
              )
            ) {
              this.checkIfExists(e, this.url.user, e.target.value, null);
            }
          } else {
            this.removeInput(e.target);
          }
        }
        break;
      case "email":
        {
          if (e.target.parentElement.querySelectorAll("input")[0].value) {
            if (this.checkEmail(el.fields.email)) {
              this.checkIfExists(e, this.url.email, null, e.target.value);
            }
          } else {
            this.removeInput(e.target);
          }
        }
        break;
      case "password":
        {
          if (e.target.value) {
            this.checkPassword(el.fields.password);
          } else {
            this.removeInput(e.target);
          }
        }
        break;
    }
  },
  eventHandler(el, e) {
    //e.preventDefault();
    switch (e.type) {
      // case "submit":
      //   {
      //     this.checkLength(
      //       this.fields.username,
      //       this.limits.userMin,
      //       this.limits.userMax
      //     );
      //     this.checkLength(
      //       this.fields.password,
      //       this.limits.pwMin,
      //       this.limits.pwMax
      //     );
      //     this.checkEmail(this.fields.email);
      //     const registerObject = {
      //       csrf: el.fields.csrf.value,
      //       username: el.fields.username.value,
      //       email: el.fields.email.value,
      //       password: el.fields.password.value,
      //     };
      //     this.registerUser(this.url.register, registerObject);
      //   }
      //   break;
      case "input":
        {
          this.removeInput(e.target);
          clearTimeout(this.inputTimer);
          this.inputTimer = setTimeout(() => {
            this.eventContent(el, e);
          }, 1000);
        }
        break;
      case "change":
        {
          this.eventContent(el, e);
        }
        break;
    }
  },
  init() {
    this.addEventListeners();
  },
  registerUser(fetchUrl, registerObject) {
    fetch(fetchUrl, {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify(registerObject),
    })
      .then((response) => response.json())
      .then((resData) => {
        console.log(resData);
      });
  },
  removeInput(el) {
    el.parentElement.classList.remove("error");
    el.parentElement.classList.remove("success");
    el.parentElement.querySelector("span").querySelector("small").innerText =
      "";
  },
  showError(el, message) {
    el.parentElement.classList.add("error");
    el.parentElement
      .querySelector("span")
      .querySelector("small").innerText = message;
  },
  showSuccess(el) {
    el.parentElement.classList.add("success");
    this.changeReadyStatus(el.id.toLowerCase(), true);
  },
  changeReadyStatus(el, condition) {
    this.readyStatus[el] = condition;
    if (
      this.readyStatus.username === true &&
      this.readyStatus.email === true &&
      this.readyStatus.password === true
    ) {
      this.fields.regSubmit.disabled = false;
    } else {
      this.fields.regSubmit.disabled = true;
    }
  },
};

document.getElementById("regform") && regFrm.init();
