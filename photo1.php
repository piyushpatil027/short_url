<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './redis_connect.php';
$url = $_GET["url"];

$objRedis = new Redis_Connect();
 $image_path = $objRedis->get($url);
?>
<img src="<?php  echo $image_path ?>">