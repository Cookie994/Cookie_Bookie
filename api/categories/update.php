<?php
    //Headers
    header('Access-Control-Allow-Origin: *'); //public
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT'); //put method
    //headers allowed
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/categories.php';

    //Instantiate DB object
    $database = new Database();
    $db = $database->connect();

    //Category obj
    $category = new Category($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $category->id = $data->id;
    $category->name = $data->name;

    if($category->update()) {
        echo json_encode(
            array('message' => 'Category Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Updated')
        );
    }
?>