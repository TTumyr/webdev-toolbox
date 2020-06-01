<?php
    class DBQuery {
        public $pdo;
        public $allowed;
        public $sql;

        public function __construct($pdo, $allowed, $sql) {
            $this->pdo = $pdo;
            $this->allowed = $allowed;
            $this->sql = $sql;
        }

        public function get() {
            foreach($this->allowed as $allow) {
                header('Access-Control-Allow-Origin:' . $allow);
                if($allow) { //IMPORTANT change to $_SERVER['HTTP_ORIGIN'] === $allow
                    try {
                    $stmt = $this->pdo->prepare($this->sql);
                    $stmt->execute();
                    $data = [];
    
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        array_push($data, $row);
                    }
                    $json = json_encode($data);
                    echo($json);
                    die();
                } catch (Exception $e) {
                    echo "An error occurred";
                    }
                }
            }
        }
    }
 ?>