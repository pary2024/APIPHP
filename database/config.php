




<?php
    //create db



    //connect db

    $con = mysqli_connect("localhost", "root", "", "storeproduct",3306);

    //CREATE PRODUC TTABLE

    $sql = "CREATE TABLE IF NOT EXISTS `products`(
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(255) NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `qty` int(10) NOT NULL,
        `description` text NOT NULL,
        `image` varchar(255) NOT NULL,
        `update_at` timestamp  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `create_at` timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    mysqli_query($con,$sql);





?>