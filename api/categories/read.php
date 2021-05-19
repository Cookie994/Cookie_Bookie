<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/categories.php';

    //Instantiate DB object
    $database = new Database();
    $db = $database->connect();

    //Category obj
    $category = new Category($db);
    //call the function, check if there are categories annd put them in array
    $res = $category->read();
    $num = $res->rowCount();
    if($num > 0) {
        $cat_arr = array();

        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $cat_item = array('id' => $id, 'name' => $name);
            array_push ($cat_arr, $cat_item);
        }

        //turn to JSON
        echo json_encode($cat_arr);
    } else {
        echo json_encode(array('message' => 'No categories found'));
    }
?>