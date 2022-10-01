<?php 

	include "database.php";
	session_start();

    $id = addslashes($_POST['id']);
    $name = addslashes($_POST['name']);

    $sql_update = "UPDATE categories SET name = '$name' WHERE id = $id;";


    //print($sql_update);

    $query = mysqli_query($connect,$sql_update);

    header("location: listCategory.php");    

 ?>