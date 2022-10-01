<?php

include("database.php");
require_once('vendor/stripe-php/init.php');
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LnXU3DUGTCz2iFTXzfgE7pRUHyxZBSQP5h3tgS8vtYrgipEwGJcFqnzapjsXD58sf2lREIU2zBhHpXXOnYvd8j500a35McRy7');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost';

$id_product = $_POST['id_product'];
$quantity_product = $_POST['quantity_product'];
$total_price = $_POST['total_price'];
$id_user = $_POST['id_user'];
$frete = $_POST['frete'];
$date = date('Y-m-d H:i:s');

$frete_price = floatval(str_replace(",", ".", $_POST['frete_price']));
$frete_deadline = $_POST['frete_deadline'];
$frete_name = $_POST['frete_name'];

$sql = "INSERT INTO user_order (user_id,total_price,frete,order_date) VALUES ('$id_user','$total_price','$frete','$date')";
$query = mysqli_query($connect, $sql);
$lastid = mysqli_insert_id($connect);

$products = [];
foreach ($id_product as $key => $value) {
    $sql = "INSERT INTO product_order (user_id,product_id,quantity,order_id) VALUES ('$id_user','$id_product[$key]','$quantity_product[$key]','$lastid')";
    $query = mysqli_query($connect, $sql);

    $productSql = "SELECT * FROM products WHERE id = '$id_product[$key]'";
    $queryProduct = mysqli_query($connect, $productSql);

    $imageSql = "SELECT * FROM img_product WHERE product_id = '$id_product[$key]' LIMIT 1";
    $queryImage = mysqli_query($connect, $imageSql);

    $productImage = '';
    while ($row = mysqli_fetch_array($queryImage)) {
        $productImage = $row['url'];
    }

    while ($row = mysqli_fetch_array($queryProduct)) {
        $products[] = [
            'price_data' => [
                'currency' => 'brl',
                'unit_amount' => $row['price'] * 100,
                'product_data' => [
                    'name' => $row['name'],
                    // 'description' => html_entity_decode(strip_tags($row['description'])),
                    'images' => ['http://localhost/assets/img/Product%20Img/' . $productImage],
                ],
            ],
            'quantity' => $quantity_product[$key],
        ];
    }
}

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card', 'boleto'],
    'line_items' => $products,
    'shipping_options' => [
        [
            'shipping_rate_data' => [
                'type' => 'fixed_amount',
                'fixed_amount' => [
                    'amount' => $frete_price * 100,
                    'currency' => 'brl',
                ],
                'display_name' => $frete_deadline,
            ]
        ],
    ],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . "/confirmOrder.php?order=$lastid&complete=true&session_id={CHECKOUT_SESSION_ID}",
    'cancel_url' => $YOUR_DOMAIN . "/confirmOrder.php?order=$lastid&complete=false",
]);

$_SESSION["cart"] = [];

header("Location: " . $checkout_session->url);
