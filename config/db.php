<?php
    class Database {
        //params
        private $host = 'localhost';
        private $db_name = 'cookie_bookie';
        private $username = 'root';
        private $password = '';
        private $conn;

        //connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Conncetion Error:' . $e->getMessage();
            }

            return $this->conn;
        }
    }
?>