<?php
    //headers
    header('Access-Control-Allow-Origin: *'); //public API
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/recipe.php';

    //conn
    $database = new Database();
    $db = $database->connect();

    //get recipes
    $recipe = new Recipe($db);
    $res = $recipe->read();
    $num = $res->rowCount();
    if($num > 0) {
        $recipe_arr = array();

        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $recipe_item = array(
                'id' => $id,
                'category_id' => $category_id,
                'category_name' => $category_name,
                'recipe_name' => $recipe_name,
                'ingredients' => $ingredients,
                'time' => $time
            );
            array_push($recipe_arr, $recipe_item);
        }

        //turn to json
        echo json_encode($recipe_arr);
    } else {
        echo json_encode(array('message' => 'No recipes found'));
    }
?>