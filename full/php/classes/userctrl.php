<?php
    class UserCtrl {
        public function __construct() {
            $this->cfg = new Cfg();
            //$this->auth = new Auth();
            //$this->dbquery = new DBQuery();
            $this->user='';
        }
        public function init() {
            $this->test();
        }
        private function test() {
            print_r($cfg);
            echo("This was run");
            echo("</br>");
        }
    }
?>