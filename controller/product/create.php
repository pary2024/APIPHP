<?php

include "../../database/config.php";
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
//allow any requests

header("Access-Control-Allow-Methods: POST");
//allow post requests
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

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
    if (!isset($price) || $price <= 0) {
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
    //store to db 
    // 
    // $price = floatval($price); // Ensures price is a valid float
    // $qty = intval($qty);

    //convert name to
    $name = mysqli_real_escape_string($con, $name);
    //care user use the single koade
    $sql = "INSERT INTO `products` (`name`, `price`,`qty`) VALUES (
            '$name',
            '$price',
            '$qty'
        )";
    $result = mysqli_query($con, $sql);
    ///fetch to array key

    // $product = mysqli_fetch_assoc($result);



    //current insert
    $last_id = mysqli_insert_id($con);

    $sql = "SELECT * FROM `products` WHERE `id` = '$last_id'";
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($result);






    http_response_code(201);
    echo json_encode([
        "status"=>201,
        "product"=> $product,
        "message" => "Data Berhasil Di Tambahkan"
    ]);



}else{
    http_response_code(405);
    echo json_encode([
        "status"=>405,
        "message" => "Data Berhasil Di Tambahkan"
    ]);
}












?>