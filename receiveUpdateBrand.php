<?php 

	include "database.php";
	session_start();

    $id = addslashes($_POST['id']);
    $name = addslashes($_POST['name']);
    $cnpj = addslashes($_POST['cnpj']);

    if(isset($cnpj) && !empty($cnpj)){
        $sql_update = "UPDATE brands SET name = '$name', cnpj = '$cnpj' WHERE id = $id;";
    }else{
        $sql_update = "UPDATE brands SET name = '$name', cnpj = 'NULL' WHERE id = $id;";
    }

    //print($sql_update);

    $query = mysqli_query($connect,$sql_update);

    header("location: listBrand.php");    

 ?>