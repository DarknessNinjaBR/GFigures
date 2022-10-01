<?php
include "database.php";

$name = addslashes($_POST['name']);

if(isset($name) && !empty($name)){

$verification = mysqli_query($connect, "SELECT * FROM categories WHERE name = '$name'");

#Se o retorno for maior do que zero, diz que já existe um.
if(mysqli_num_rows($verification)>0){
    //echo json_encode(array('	email' => 'Ja existe um usuario cadastrado com este e-mail')); 
    header("location: listCategory.php?error=1");
}else{
    $sql = "INSERT INTO categories (name) VALUES ('$name');";
    $query = mysqli_query($connect,$sql);
    header("location: listCategory.php");
}

}else{
    header("location: listCategory.php?error=2");
}
?>