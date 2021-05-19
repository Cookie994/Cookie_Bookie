<?php
    class Category {
        //DB
        private $conn;
        private $table = 'categories';

        //Properties
        public $id;
        public $name;

        //Constructor DB
        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'SELECT id, name FROM ' . $this->table . '';

            //stmt
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function create() {
            $query = 'INSERT INTO ' . $this->table . ' SET name = ?';

            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $stmt->bindParam(1, $this->name);

            if($stmt->execute()) {
                return true;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        public function update() {
            $query = 'UPDATE ' . $this->table . ' SET name = ? WHERE id = ?';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->id);

            if($stmt->execute()) {
                return true;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id =?';
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);


            if($stmt->execute()) {
                return true;
            }

            //Print err if goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;

        }
    }
?>