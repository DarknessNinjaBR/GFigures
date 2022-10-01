<?php
include "database.php";

$email = addslashes($_POST['email']);
$password = md5(addslashes($_POST['password']));

if(isset($email) && !empty($email) && isset($password) && !empty($password)){

$verification = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");

#Se o retorno for maior do que zero, diz que já existe um.
if(mysqli_num_rows($verification)<1){
    header("location: formLogin.php?error=1");

}else{
    session_start();
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password';";
		$query = mysqli_query($connect, $sql);
		if($dados = mysqli_fetch_array($query)){
            session_start();
			$_SESSION["id"] = $dados['id'];
            $_SESSION["email"] = $dados['email'];
			$_SESSION["first_name"] = $dados['first_name'];
			$_SESSION["cep"] = $dados['cep'];
			$_SESSION['frete'] = "";
			$_SESSION["admin"] = $dados['admin'];
			$_SESSION["cart"] = [];

			header("location: index.php");
		}else{
			header("location: formlogin.php?error=2");
		}
}

}

?>