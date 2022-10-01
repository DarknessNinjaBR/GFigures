<?php

require_once('vendor/stripe-php/init.php');
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LnXU3DUGTCz2iFTXzfgE7pRUHyxZBSQP5h3tgS8vtYrgipEwGJcFqnzapjsXD58sf2lREIU2zBhHpXXOnYvd8j500a35McRy7');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/public';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card', 'boleto'],
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'brl',
        'unit_amount' => 2000,
        'product_data' => [
          'name' => 'T-shirt',
          'description' => 'Comfortable cotton t-shirt',
          'images' => ['https://cf.shopee.com.br/file/0e7a7d4d51017288c6abf16b57cde1bc'],
        ],
      ],
      'quantity' => 1,
    ],
    [
      'price_data' => [
        'currency' => 'brl',
        'unit_amount' => 2000,
        'product_data' => [
          'name' => 'T-Ass Cock',
          'description' => 'Comfortable cock ass',
          'images' => ['https://metro.co.uk/wp-content/uploads/2013/07/ay_113920880.jpg?quality=90&strip=all&zoom=1&resize=480%2C360'],
        ],
      ],
      'quantity' => 2,
    ]
  ],
  'shipping_options' => [
    [
      'shipping_rate_data' => [
        'type' => 'fixed_amount',
        'fixed_amount' => [
          'amount' => 1500,
          'currency' => 'brl',
        ],
        'display_name' => 'Next day air',
        // Delivers in exactly 1 business day
        'delivery_estimate' => [
          'minimum' => [
            'unit' => 'business_day',
            'value' => 1,
          ],
          'maximum' => [
            'unit' => 'business_day',
            'value' => 1,
          ],
        ]
      ]
    ],
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
