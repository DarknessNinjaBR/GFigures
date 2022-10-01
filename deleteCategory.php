<?php

include ("database.php");
session_start();

$sql = "DELETE FROM categories WHERE id = $_GET[id]";

mysqli_query($connect, $sql);
header("location: listCategory.php"); 