<?php

include "../../database/config.php";
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
//allow any requests

header("Access-Control-Allow-Methods: POST");
//allow post requests
$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'POST') {
    //create data 
    $data = json_decode(file_get_contents("php://input"), true);
    //change pi json to array key\
    $name = $data['name'];
    $price = $data['price'];
    $qty   = $data['qty'];




    //validation 

    $error= [];

    if (empty($name)) {
        $error['name'] = "name is required";
    
    }
    if (!isset($price)|| $price <= 0) {
        $error['price'] = "price is required";
    }
    //intval yr lek int 
    if (!isset($qty)|| $qty <= 0 || intval($qty) != $qty){
        $error['qty'] = "quantity is required";
    }
    if (!empty($error)){
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "message" => "invalid data",
            "errors" =>$error
        ]);
        exit();

    }
    $id = $_GET['id'];
    $name = mysqli_escape_string($con,$name);
    $sql = "UPDATE `products` SET 
        `name`='$name',
        `price`='$price',
        `qty`='$qty'
         WHERE `id`='$id'";

         mysqli_query($con,$sql);

         http_response_code(201);
         echo json_encode([
            "status"=> 201,
            "message"=>"product updated successfully",
         ]);
}else{
    http_response_code(405);
    echo json_encode([
        "status" => 405,
        "message" => "method not allowed",
    ]);
}
