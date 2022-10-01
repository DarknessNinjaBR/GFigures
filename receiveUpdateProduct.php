<?php

include "database.php";
session_start();

$id = $_POST['id'];
$name = addslashes($_POST['name']);
$description = addslashes($_POST['description']);
$price = addslashes($_POST['price']);
$category_id = addslashes($_POST['category_id']);
$brand_id = addslashes($_POST['brand_id']);
$launch = addslashes($_POST['launch']);
$sale = addslashes($_POST['sale']);
$old_price = addslashes($_POST['old_price']);

$date = date('Y-m-d H:i:s');

$priceConvert = str_replace(".", "", $price);
$priceConvert = str_replace(",", ".", $priceConvert);

$priceConvertOld = str_replace(".", "", $old_price);
$priceConvertOld = str_replace(",", ".", $priceConvertOld);


$imgs = $_FILES['imgs']['name'];

$sql_update = "UPDATE products SET name = '$name', description = '$description', price = '$priceConvert', category_id = '$category_id', brand_id = '$brand_id', launch = '$launch', sale = '$sale', old_price = '   $priceConvertOld'  WHERE id = $id;";


$query = mysqli_query($connect, $sql_update);




if ($imgs[0] != "") {

    $sql_img = "DELETE FROM img_product WHERE product_id = $id";

    $query_img = mysqli_query($connect, $sql_img);

    for ($i = 0; $i < count($imgs); $i++) {
        //echo($imgs[$i]);
        $img_name = addslashes(md5($_FILES['imgs']['tmp_name'][$i]) . "-" . $_FILES['imgs']['name'][$i]);



        $sql = "INSERT INTO img_product (product_id,url) VALUES ('$id','$img_name')";

        $query_img = mysqli_query($connect, $sql);

        move_uploaded_file($_FILES['imgs']['tmp_name'][$i], "assets/img/Product Img/$img_name");
    }
    header("location: listProduct.php");
} else {
    header("location: listProduct.php");
}
