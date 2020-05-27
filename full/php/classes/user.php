<?php
    class User {
        public function __construct($origin, $session, $post) {
            $this->json = json_decode(file_get_contents('php://input'), true);
            $this->cfg = new Cfg();
            $this->origin = $origin;
            $this->session = $session;
            $this->post = $post;
            $this->username = trim($post['username']);
            if(isset($post['email'])) {
                $this->email = trim($post['email']);
            }
            $this->password = $post['password'];
            if(!isset($this->session["csrf"])) {
                $this->session["csrf"] = '';
            }
            $this->auth = new Auth($this->cfg->origin, $this->origin, $this->session["csrf"], $this->post["csrf"]);
            $this->db = new mySQL();
            $this->DBQuery = new DBQuery($this->db->pdo);
            $this->usernameMin = 3;
            $this->usernameMax = 255;
            $this->passwordMin = 3;
            $this->passwordMax = 255;
            $this->errors = [];
            $this->insertedUser = [];
            $this->regFail = false;
            $this->loginAuth = false;
            $this->adminLevel = 2;
        }
        public function login() {
            $this->auth->check();
            if($this->auth->verified) {
                $this->loginUser();
            }
        }
        public function register() {
            $this->auth->check();
            if($this->auth->verified) {
                $this->formValidCheck();
                $this->insertUser();
            }
        }
        private function loginUser() {
            $this->DBQuery->querySpecific("*", $this->db->users['table'], $this->db->users['name'], $_POST['username']);
            $this->DBQuery->get($this->DBQuery->sql);
            if(password_verify($_POST['password'], $this->DBQuery->data[0]['password'])) {
                $this->loginAuth = true;
                ($this->DBQuery->data[0]['level'] >=  $this->adminLevel) ? $_SESSION['admin'] = true :  $_SESSION['admin'] = false;
                $_SESSION['auth'] = true;
                $_SESSION['username'] = $this->DBQuery->data[0]['name'];
                $_SESSION['email'] = $this->DBQuery->data[0]['email'];
            }
        }
        private function formValidCheck() {
            //Validating registration form data
            if (strlen($this->username) < $this->usernameMin) {
                $this->errors['nameError'] = "Username must be at least " . $this->usernameMin . " characters long";
            } elseif (!preg_match("/^[a-zA-Z0-9]+$/",$this->username)) {
                $this->errors['nameError'] = "Username may only contain characters and numbers";
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                $this->errors['emailError'] = "Please enter a valid email";
            }
            if(strlen($this->password) < $this->passwordMin) {
                $this->errors['passwordError'] = "Password must be minimum " . $this->passwordMin . " characters long";
            }
            if(empty($this->errors)) {
                $this->DBQuery->querySpecific($this->db->users['name'], $this->db->users['table'], $this->db->users['name'], $_POST['username']);
                $this->DBQuery->get($this->DBQuery->sql);
                if(!empty($this->DBQuery->data)) {
                    $this->errors['nameError'] = "Username already taken";
                    print_r($this->errors);
                }
                $this->DBQuery->data = [];
                $this->DBQuery->querySpecific($this->db->users['email'], $this->db->users['table'], $this->db->users['email'], $_POST['email']);
                $this->DBQuery->get($this->DBQuery->sql);
                if(!empty($this->DBQuery->data)) {
                    $this->errors['emailError'] = "Email already registered";
                }
            }       
        }
        private function insertUser() {
            $this->insertedUser["name"] = $this->username;
            $this->insertedUser["email"] = $this->email;
            if(empty($this->errors)) {
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $this->DBQuery->insert($this->db->users['table'], $this->db->users['name'], $this->db->users['email'], $this->db->users['password'], $this->username, $this->email, $this->password);
            } else {
                $this->regFail = true;
            }
        }
    }
?>