//
const regFrm = {
  form: document.getElementById("regform"),
  // form fields
  fields: {
    csrf: document.getElementById("csrf"),
    username: document.getElementById("username"),
    email: document.getElementById("email"),
    cemail: document.getElementById("cemail"),
    password: document.getElementById("password"),
    cpassword: document.getElementById("cpassword"),
  },
  valid: {
    userMin: 4,
    userMax: 30,
    pwMin: 3,
    pwMax: 255,
  },
  inputTimer: "",
  // form functions
  showError(input, message) {
    const formControl = input.parentElement;
    formControl.classList.add("error");
    const span = formControl.querySelector("span");
    const small = span.querySelector("small");
    small.innerText = message;
  },
  showSuccess(input) {
    const formControl = input.parentElement;
    formControl.classList.add("success");
  },
  getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
  },
  removeInput(input) {
    const formControl = input.parentElement;
    formControl.classList.remove("error");
    formControl.classList.remove("success");
    const span = formControl.querySelector("span");
    const small = span.querySelector("small");
    small.innerText = "";
  },
  checkRequired(inputArr) {
    inputArr.forEach((input) => {
      if (input.value.trim() === "") {
        this.showError(input, `${this.getFieldName(input)} is required`);
      } else {
        this.showSuccess(input);
      }
    });
  },
  checkLength(input, min, max) {
    this.removeInput(input);
    if (input.value.length < min) {
      this.showError(
        input,
        `${this.getFieldName(input)} must be at least ${min} characters`
      );
    } else if (input.value.length > max) {
      this.showError(
        input,
        `${this.getFieldName(input)} must be less than ${max} characters`
      );
    } else {
      return true;
      //this.showSuccess(input);
    }
  },
  checkEmail(input1, input2) {
    this.removeInput(input1);
    const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (
      emailReg.test(input1.value.trim()) &&
      emailReg.test(input2.value.trim()) &&
      input1.value === input2.value
    ) {
      this.showSuccess(input1);
    } else if (input1.value !== input2.value) {
      this.showError(input1, "Emails do not match");
    } else {
      this.showError(input1, "Email is not valid");
    }
  },
  checkPassword(input1, input2) {
    this.removeInput(input1);
    if (input1.value !== input2.value) {
      this.showError(input2, "Passwords do not match");
    } else {
      this.checkLength(
        this.fields.password,
        this.valid.pwMin,
        this.valid.pwMax
      );
    }
  },
  inputHandler(fields, e) {
    this.inputTimer = setTimeout(() => {
      console.log(e);
      switch (e.target.name) {
        case "username":
          {
            if (e.target.value !== "") {
              //checks if username meets requiremenets
              if (
                this.checkLength(
                  fields.username,
                  this.valid.userMin,
                  this.valid.userMax
                )
              ) {
                fetch("http://localhost/json/username", {
                  headers: {
                    "Content-Type": "application/json",
                  },
                  method: "POST",
                  body: JSON.stringify({
                    csrf: this.fields.csrf.value,
                    username: e.target.value,
                  }),
                })
                  .then((response) => response.json())
                  .then((resdata) => console.log(resdata));
              }
            } else {
              this.removeInput(e.target);
            }
          }
          break;
        case "email":
        case "cemail":
          {
            if (
              e.target.parentElement.querySelectorAll("input")[0].value ||
              e.target.parentElement.querySelectorAll("input")[1].value !== ""
            ) {
              this.checkEmail(fields.email, fields.cemail);
            } else {
              this.removeInput(e.target);
            }
          }
          break;
        case "password":
        case "cpassword":
          {
            if (
              e.target.parentElement.querySelectorAll("input")[0].value ||
              e.target.parentElement.querySelectorAll("input")[1].value !== ""
            ) {
              this.checkPassword(fields.password, fields.cpassword);
            } else {
              this.removeInput(e.target);
            }
          }
          break;
      }
    }, 2000);
  },
  eventHandler(fields, e) {
    e.preventDefault();
    switch (e.type) {
      case "submit":
        {
          this.checkRequired([
            fields.username,
            fields.email,
            fields.cemail,
            fields.password,
            fields.cpassword,
          ]);
          this.checkLength(
            fields.username,
            this.valid.userMin,
            this.valid.userMax
          );
          this.checkLength(fields.password, this.valid.pwMin, this.valid.pwMax);
          this.checkEmail(fields.email, fields.cemail);
          this.checkPassword(fields.password, fields.cpassword);
        }
        break;
      case "change":
      case "input": //TOREVIEW
        {
          clearTimeout(this.inputTimer);
          this.inputTimer = setTimeout(() => {
            switch (e.target.name) {
              case "username":
                {
                  if (e.target.value !== "") {
                    //checks if username meets requiremenets
                    if (
                      this.checkLength(
                        fields.username,
                        this.valid.userMin,
                        this.valid.userMax
                      )
                    ) {
                      fetch("http://localhost/json/username", {
                        headers: {
                          "Content-Type": "application/json",
                        },
                        method: "POST",
                        body: JSON.stringify({
                          csrf: this.fields.csrf.value,
                          username: e.target.value,
                        }),
                      })
                        .then((response) => response.json())
                        .then((resdata) => console.log(resdata));
                    }
                  } else {
                    this.removeInput(e.target);
                  }
                }
                break;
              case "email":
              case "cemail":
                {
                  if (
                    e.target.parentElement.querySelectorAll("input")[0].value ||
                    e.target.parentElement.querySelectorAll("input")[1]
                      .value !== ""
                  ) {
                    this.checkEmail(fields.email, fields.cemail);
                  } else {
                    this.removeInput(e.target);
                  }
                }
                break;
              case "password":
              case "cpassword":
                {
                  if (
                    e.target.parentElement.querySelectorAll("input")[0].value ||
                    e.target.parentElement.querySelectorAll("input")[1]
                      .value !== ""
                  ) {
                    this.checkPassword(fields.password, fields.cpassword);
                  } else {
                    this.removeInput(e.target);
                  }
                }
                break;
            }
          }, 2000);
        }
        break;
    }
  },

  // event listeners
  addEventListeners() {
    ["submit", "input"].forEach((listen) => {
      this.form.addEventListener(
        listen,
        this.eventHandler.bind(this, this.fields)
      );
    });
  },
  init() {
    this.addEventListeners();
  },
};

regFrm.init();
