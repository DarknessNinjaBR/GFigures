<?php

$complete = $_GET['complete'];
$order_id = $_GET['order'];
$session_id = $_GET['session_id'];
var_dump($complete, $order_id, $session_id);
die();
$sql = '';
if ($complete) {
    $sql = 'UPDATE user_order';
} else {
    $sql = 'UPDATE user_order';
}
