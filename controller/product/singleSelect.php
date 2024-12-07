<?php

include "../../database/config.php";
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
//allow any requests

header("Access-Control-Allow-Methods: GET");
//allow post requests
$method = $_SERVER['REQUEST_METHOD'];



if ($method === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($result);
    http_response_code(200);
    echo json_encode([
        "status" => 200,
        "product"=> $product,
        "message" => "User found",
    ]);

}