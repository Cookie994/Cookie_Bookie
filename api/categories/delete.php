<?php
    //headers
    header('Access-Control-Allow-Origin: *'); //public API
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE'); //DELETE method allowed
    //which headsers I'm allowing
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/categories.php';

    //conn
    $database = new Database();
    $db = $database->connect();

    //get Categories
    $categories = new Category($db);
    
    //Get raw posted data
     $data = json_decode(file_get_contents("php://input"));

     //Set ID to delete
     $categories->id = $data->id;

     if($categories->delete()) {
         echo json_encode(
             array('message' => 'Category Deleted')
         );
     } else {
         echo json_encode(
             array('message' => 'Category Not Deleted')
         );
     }
?>