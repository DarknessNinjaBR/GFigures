<?php

include ("database.php");
session_start();

$sql = "DELETE FROM products WHERE id = $_GET[id]";
mysqli_query($connect, $sql);

$sql_img = "DELETE FROM img_product WHERE product_id = $_GET[id]";
mysqli_query($connect, $sql_img);
header("location: listProduct.php"); 