<?php
    class User {
        public function __construct($origin, $session, $post) {
            $this->json = json_decode(file_get_contents('php://input'), true);
            $this->cfg = new Cfg();
            $this->origin = $origin;
            $this->session = $session;
            $this->post = $post;
            $this->username = trim($post['username']);
            $this->email = trim($post['email']);
            $this->password = $post['password'];
            $this->auth = new Auth($this->cfg->origin, $this->origin, $this->session["csrf"], $this->post["csrf"]);
            $this->db = new mySQL();
            $this->DBQuery = new DBQuery($this->db->pdo);
            $this->usernameMin = 3;
            $this->usernameMax = 255;
            $this->passwordMin = 3;
            $this->passwordMax = 255;
            $this->errors = [];
        }
        public function register() {
            $this->auth->check();
            $this->formValidCheck();
            $this->insertUser();
        }
        public function formValidCheck() {
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
            if(empty($this->errors)) {
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $this->DBQuery->insert($this->db->users['table'], $this->db->users['name'], $this->db->users['email'], $this->db->users['password'], $this->username, $this->email, $this->password);
            } else {
                echo("an error occurred");
            }
        }
    }
?>