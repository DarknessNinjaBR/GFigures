<?php
include "database.php";

$name = addslashes($_POST['name']);
$description = addslashes($_POST['description']);
$price = addslashes($_POST['price']);
$category_id = addslashes($_POST['category_id']);
$brand_id = addslashes($_POST['brand_id']);
$launch = addslashes($_POST['launch']);
$sale = addslashes($_POST['sale']);
$old_price = addslashes($_POST['old_price']);

$date = date('Y-m-d H:i:s');
$imgs = $_FILES['imgs']['name'];

$priceConvert = str_replace(".","",$price);
$priceConvert = str_replace(",",".",$priceConvert);

 $priceConvertOld = str_replace(".","",$old_price);
    $priceConvertOld = str_replace(",",".",$priceConvertOld);

$sql = "INSERT INTO products (name,description,price,category_id,brand_id,launch,sale,old_price) VALUES ('$name','$description','$priceConvert','$category_id','$brand_id','$launch','$sale','$priceConvertOld')";

//echo($sql);

$query = mysqli_query($connect,$sql);
$lastid = mysqli_insert_id($connect);
for ($i=0; $i < count($imgs); $i++) { 
    //echo($imgs[$i]);
    $img_name = addslashes(md5($_FILES['imgs']['tmp_name'][$i])."-".$_FILES['imgs']['name'][$i]);

    $sql = "INSERT INTO img_product (product_id,url) VALUES ('$lastid','$img_name')";

    $query_img = mysqli_query($connect,$sql);

    move_uploaded_file($_FILES['imgs']['tmp_name'][$i],"assets/img/Product Img/$img_name");
}

header("location: index.php");