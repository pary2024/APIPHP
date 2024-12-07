<?php

include "../../database/config.php";
header("Content-Type: application/json");
  
header("Access-Control-Allow-Origin: *");
//allow any requests

header("Access-Control-Allow-Methods: GET");
//allow post requests
$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'GET') {
    $sql = "SELECT * FROM `products`";
    $result = mysqli_query($con, $sql);
    $product= mysqli_fetch_all($result, MYSQLI_ASSOC);
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "product"=> $product,
        "message" => "Products retrieved successfully",
    ]);
}else{
    http_response_code(405);
    echo json_encode([
        "status"=> 405,
        "message" => "Method Not Allowed"
    ]);
}