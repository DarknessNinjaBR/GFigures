<?php

include ("database.php");
session_start();

$sql = "DELETE FROM brands WHERE id = $_GET[id]";

mysqli_query($connect, $sql);
header("location: listBrand.php"); 