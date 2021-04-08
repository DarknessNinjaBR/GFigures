<?php 

	include "database.php";
	session_start();

    $id = $_SESSION['id'];
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

    $sql_update = "UPDATE users SET email = '$email', password = '$password', first_name = '$first_name', last_name = '$last_name', cpf = '$cpf', rg = '$rg', address = '$address', address_number = '$address_number', city = '$city', state = '$state', cep = '$cep'  WHERE id = $id;";

    //print($sql_update);

    $query = mysqli_query($connect,$sql_update);

    $sql2 = "SELECT * FROM users WHERE id = $id";

    $result2 = mysqli_query($connect, $sql2);

    if($dados = mysqli_fetch_array($result2)){
        $_SESSION["id"] = $dados['id'];
        $_SESSION["email"] = $dados['email'];
        $_SESSION["first_name"] = $dados['first_name'];
        $_SESSION["admin"] = $dados['admin'];

        header("location: account.php");
    }

    header("location: account.php");

    
    


 ?>