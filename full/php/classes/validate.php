<?php
    class User_Reg_Validate {
        public function __construct($pdo) {
            $this->json = json_decode(file_get_contents('php://input'), true);
            $this->username = trim($_POST['username']) || "";
            $this->email = trim($_POST['email']) || "";
            $this->password = $_POST['password'] || "";
            $this->hash = '';
            $this->errors = [];
            $this->db = new mySQL();
            $this->DBQuery = new DBQuery($pdo);
        }
        public function registerUser() {
            $this->check();
            if(empty($this->errors)) {
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $this->DBQuery->insert($this->db->users['table'], $this->db->users['name'], $this->db->users['email'], $this->db->users['password'], $this->username, $this->email, $this->password);
            }
        }
        public function check() {
            //Validating registration form data
            if (strlen($this->username) < 3) {
                $this->errors['nameError'] = "Username must be at least 3 characters long";
            } elseif (!preg_match("/^[a-zA-Z1-9]+$/",$this->username)) {
                $this->errors['nameError'] = "Username may only contain characters and numbers";
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                $this->errors['emailError'] = "Please enter a valid email";
            }
            if(strlen($this->password) < 3) {
                $this->errors['passwordError'] = "Password must be minimum 3 characters long";
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
    }
?>