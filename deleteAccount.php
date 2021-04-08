<?php

include ("database.php");
session_start();

$sql = "DELETE FROM users WHERE id = $_SESSION[id]";

mysqli_query($connect, $sql);
session_destroy();
header("location: index.php"); 