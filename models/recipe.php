<?php
    class Recipe {
        //DB properties
        private $conn;
        private $table = 'recipes';

        //Recipe properties
        public $id;
        public $category_id;
        public $category_name;
        public $recipe_name;
        public $ingredients;
        public $time;

        //DB conn
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get recipes
        public function read() {
            //query with aliases
            $query = 'SELECT
                c.name as category_name,
                r.id,
                r.category_id,
                r.recipe_name,
                r.ingredients,
                r.time
            FROM
                ' . $this->table . ' r
            LEFT JOIN
                categories c ON r.category_id = c.id';
            //stmt
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        //get one Recipe
        public function read_single() {
            //query with aliases
            $query = 'SELECT 
                c.name as category_name,
                r.id,
                r.category_id,
                r.recipe_name,
                r.ingredients,
                r.time 
            FROM
                ' . $this->table . ' r
            LEFT JOIN
                categories c ON r.category_id = c.id
            WHERE
                r.id = ?';

            //prepare stmt
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //Set properties
            $this->recipe_name = $row['recipe_name'];
            $this->ingredients = $row['ingredients'];
            $this->time = $row['time'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];

        }

        //Create recipe
        public function create() {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                recipe_name = ?,
                ingredients = ?,
                time = ?,
                category_id = ?';

            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->recipe_name = htmlspecialchars(strip_tags($this->recipe_name));
            $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
            $this->time = htmlspecialchars(strip_tags($this->time));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(1, $this->recipe_name);
            $stmt->bindParam(2, $this->ingredients);
            $stmt->bindParam(3, $this->time);
            $stmt->bindParam(4, $this->category_id);

            if($stmt->execute()) {
                return true;
            }

            //Print err if goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;

        }

        //Update recipe
        public function update() {
            $query = 'UPDATE ' . $this->table . '
            SET
                recipe_name = ?,
                ingredients = ?,
                time = ?,
                category_id = ?
            WHERE
                id = ?';

            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->recipe_name = htmlspecialchars(strip_tags($this->recipe_name));
            $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
            $this->time = htmlspecialchars(strip_tags($this->time));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->recipe_name);
            $stmt->bindParam(2, $this->ingredients);
            $stmt->bindParam(3, $this->time);
            $stmt->bindParam(4, $this->category_id);
            $stmt->bindParam(5, $this->id);


            if($stmt->execute()) {
                return true;
            }

            //Print err if goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;

        }

        //Delete recipe
        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

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