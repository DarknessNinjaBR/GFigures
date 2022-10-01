<?php

    include ("database.php");

    $id_product = $_POST['id_product'];
    $quantity_product = $_POST['quantity_product'];
    $total_price = $_POST['total_price'];
    $id_user = $_POST['id_user'];
    $frete = $_POST['frete'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO user_order (user_id,total_price,frete,order_date) VALUES ('$id_user','$total_price','$frete','$date')";
    $query = mysqli_query($connect,$sql);
    $lastid = mysqli_insert_id($connect);

    $i = 0;
    foreach ($id_product as $key => $value) {
        $sql = "INSERT INTO product_order (user_id,product_id,quantity,order_id) VALUES ('$id_user','$id_product[$i]','$quantity_product[$i]','$lastid')";
        $query = mysqli_query($connect,$sql);
        $i++;
    }

    $_SESSION["cart"] = [];

    header("location: orders.php");

?>