<?php

include "../../database/config.php";
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
//allow any requests

header("Access-Control-Allow-Methods: GET");
//allow post requests
$method = $_SERVER['REQUEST_METHOD'];

 // delete product by pram

if ($method == 'GET') {
    $id = $_GET['id'];
    $sql = "DELETE FROM `products` WHERE `id` ='$id'";
    mysqli_query($con, $sql);
    http_response_code(200);
    echo json_encode([
        "status"=> 200,
        "message" => "Product deleted successfully"
    ]);
}