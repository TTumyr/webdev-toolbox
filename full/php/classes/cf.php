<?php
    //Site configuration
    class Cf {
        public function __construct() {
            $this->origin = ['http://localhost', 'https://localhost']; //Same origin policy. Set separate www and none-www. Example: ['http://www.domain.com', 'http://domain.com'] 
            $this->redirect = $_SERVER['REQUEST_URI'];
            $this->rD = ''; //Set directory here if not using getRD
            $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
            ////Google Recaptcha keys local for testing
            $this->gcSecret = 'google-secret-key';
            $this->gcSite = 'google-site-key';
        }
        //Can be omitted by setting $this->rD manually
        public function getRD() {
            $this-> rDCalc();
        }
        //Calculates the hosting folder
        private function rDCalc() {
            $rel_DIR = str_replace('\\','/',dirname(__DIR__,2)/*MUST point to root*/);
            $rel_ROOT = explode('/', $rel_DIR);
            $abs_ROOT = explode('/' , $_SERVER['DOCUMENT_ROOT']);
            $rootDiff = implode(array_values(array_diff($rel_ROOT, $abs_ROOT)),'/');
            ($rel_ROOT !== $abs_ROOT) ? $this->rD = '/' . $rootDiff : $this->rD ='';
        }
        
    }
    //MySQL database configuration
    class mySQL {
        public function __construct() {
            //Users table properties, must match equivalent mySQL database properties
            $this->pdo = new PDO('mysql:host=localhost;dbname=wdtools', 'root', '');
            $this->users = ['table' => 'users', 'id' => 'id', 'name' => 'name', 'password' => 'password', 'email' => 'email'];
            $this->sql = '';
        }
        public function querySpecific($field, $table, $cField = '', $criteria = '') {
            $this->sql = "SELECT " . $field ." FROM " . $table;
            $criteria !== '' ? $this->sql .= " WHERE " . $cField . " LIKE '" . $criteria . "'": "";
        }
    }
?>