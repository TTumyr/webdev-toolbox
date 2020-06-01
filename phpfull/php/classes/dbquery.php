<?php
    class DBQuery {

        public function __construct($pdo) {
            $this->pdo = $pdo;
            $this->sql ='';
            $this->data = [];
        }
        public function get($sql) {
            $this->sql = $sql;
            $this->getData();
        }
        public function register($sql) {
            $this->sql = $sql;
        }
        private function getData() {
                    try {
                    $stmt = $this->pdo->prepare($this->sql);
                    $stmt->execute();
    
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($this->data, $row);
                    }
                } catch (Exception $e) {
                    echo "An error occurred";
                    }
        }
        public function insert($table, $userField, $emailField, $passField, $username, $email,  $password) {
            $this->sql = "INSERT INTO " . $table . " (" . $userField . ", " . $emailField . ", " . $passField . ") VALUES (?,?,?)"; 
            try {
                $stmt = $this->pdo->prepare($this->sql);
                $stmt->execute([$username, $email, $password]);
            } catch (Exception $e) {}
        }
        public function querySpecific($fields, $table, $cField = '', $criteria = '') {
            $this->sql = "SELECT " . $fields ." FROM " . $table;
            $criteria !== '' ? $this->sql .= " WHERE " . $cField . " LIKE '" . $criteria . "'": "";
        }
    }
 ?>