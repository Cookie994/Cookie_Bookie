<?php
    //headers
    header('Access-Control-Allow-Origin: *'); //public API
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST'); //POST method allowed
    //which headers I'm allowing
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/recipe.php';

    //conn
    $database = new Database();
    $db = $database->connect();

    //get recipes
    $recipe = new Recipe($db);
    
    // //Get raw posted data
    //  $data = json_decode(file_get_contents("php://input"));
    //  var_dump($data);

    if(!empty($_POST)){
        $recipe->recipe_name = $_POST['name'];
        $recipe->ingredients = $_POST['ingredients'];
        $recipe->time = $_POST['time'];
        $recipe->category_id = $_POST['category'];
        $recipe->create();
    }

    
    


     
 
    //  if($recipe->create()) {
    //      echo json_encode(
    //          array('message' => 'Recipe Created')
    //      );
    //  } else {
    //      echo json_encode(
    //          array('message' => 'Recipe Not Created')
    //      );
    //  }
?>