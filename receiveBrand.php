<?php
include "database.php";

$name = addslashes($_POST['name']);
$cnpj = addslashes($_POST['cnpj']);

if(isset($name) && !empty($name)){

$verification = mysqli_query($connect, "SELECT * FROM brands WHERE name = '$name'");

#Se o retorno for maior do que zero, diz que já existe um.
if(mysqli_num_rows($verification)>0){
    //echo json_encode(array('	email' => 'Ja existe um usuario cadastrado com este e-mail')); 
    header("location: formBrand.php?error=1");
}else{
    if(isset($cnpj) && !empty($cnpj)){
    $sql = "INSERT INTO brands (name, cnpj) VALUES ('$name', '$cnpj');";
}else{
    $sql = "INSERT INTO brands (name, cnpj) VALUES ('$name', 'NULL');";
}
    $query = mysqli_query($connect,$sql);
    header("location: listBrand.php");
}

}else{
    header("location: formBrand.php?error=2");
}
?>