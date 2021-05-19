<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/recipe.php';

    //Instantiate DB object
    $database = new Database();
    $db = $database->connect();

    //Blog recipe obj
    $recipe = new Recipe($db);

    //Get ID
    $recipe->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get recipe
    $recipe->read_single();

    $recipe_arr = array(
        'id' => $recipe->id, 
        'recipe_name' => $recipe->recipe_name,
        'ingredients' => $recipe->ingredients,
        'category_id' => $recipe->category_id,
        'category_name' => $recipe->category_name,
        'time' => $recipe->time
    );

    echo json_encode($recipe_arr);

?>