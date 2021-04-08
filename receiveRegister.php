<?php
include "database.php";

$email = addslashes($_POST['email']);
$password = md5(addslashes($_POST['password']));
$first_name = addslashes($_POST['first_name']);
$last_name = addslashes($_POST['last_name']);
$cpf = addslashes($_POST['cpf']);
$rg = addslashes($_POST['rg']);
$address = addslashes($_POST['address']);
$address_number = addslashes($_POST['address_number']);
$city = addslashes($_POST['city']);
$state = addslashes($_POST['state']);
$cep = addslashes($_POST['cep']);

if(isset($email) && !empty($email) && isset($password) && !empty($password)){

$verification = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");

#Se o retorno for maior do que zero, diz que já existe um.
if(mysqli_num_rows($verification)>0){
    echo json_encode(array('	email' => 'Ja existe um usuario cadastrado com este e-mail')); 
    header("location: formRegister.php?error=1");
}else{
    $sql = "INSERT INTO users (email, password, first_name, last_name, cpf, rg, address, address_number, city, state, cep, admin) VALUES ('$email', '$password','$first_name','$last_name','$cpf','$rg','$address','$address_number','$city','$state','$cep', 0);";
    $query = mysqli_query($connect,$sql);
    header("location: formLogin.php");
}

}else{
    header("location: formRegister.php?error=2");
}
?>