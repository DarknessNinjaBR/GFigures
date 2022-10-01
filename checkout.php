<?php

session_start();
include("database.php");
require_once('vendor/stripe-php/init.php');

$key = 'pk_test_51LnXU3DUGTCz2iFTgIC8r7TW7EoubK7vOQTNKMfMOfqCT768FWuifR1YTOuFF3FMeEzT3BqXLHoA0pgXgMDkSbKg00NvlvAE1n';
$secret = 'sk_test_51LnXU3DUGTCz2iFTXzfgE7pRUHyxZBSQP5h3tgS8vtYrgipEwGJcFqnzapjsXD58sf2lREIU2zBhHpXXOnYvd8j500a35McRy7';

$stripe = new \Stripe\StripeClient($key);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="/create-checkout-session.php">aaa</a>
    <!-- Display errors returned by checkout session -->
    <div id="paymentResponse" class="hidden"></div>

    <!-- Product details -->
    <h2>TESTE</h2>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    <p>Price: <b>R$ 10,00</b></p>

    <!-- Payment button -->
    <button class="stripe-button" id="payButton">
        <div class="spinner hidden" id="spinner"></div>
        <span id="buttonText">Pay Now</span>
    </button>

    <script src="https://js.stripe.com/v3/" data-key="pk_test_51LnXU3DUGTCz2iFTgIC8r7TW7EoubK7vOQTNKMfMOfqCT768FWuifR1YTOuFF3FMeEzT3BqXLHoA0pgXgMDkSbKg00NvlvAE1n" data-amount=10 data-name="teste" data-description="teste" data-currency="brl" data-locale="auto">
    </script>
    <script>
        const stripe = Stripe('pk_test_51LnXU3DUGTCz2iFTgIC8r7TW7EoubK7vOQTNKMfMOfqCT768FWuifR1YTOuFF3FMeEzT3BqXLHoA0pgXgMDkSbKg00NvlvAE1n');
        // Select payment button
        const payBtn = document.querySelector("#payButton");
        // Payment request handler
        payBtn.addEventListener("click", function(evt) {
            setLoading(true);

            createCheckoutSession().then(function(data) {
                if (data.sessionId) {
                    stripe.redirectToCheckout({
                        sessionId: data.sessionId,
                    }).then(handleResult);
                } else {
                    handleResult(data);
                }
            });
        });

        // Create a Checkout Session with the selected product
        const createCheckoutSession = function(stripe) {
            return fetch("payment_init.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    createCheckoutSession: 1,
                }),
            }).then(function(result) {
                return result.json();
            });
        };

        // Handle any errors returned from Checkout
        const handleResult = function(result) {
            if (result.error) {
                showMessage(result.error.message);
            }

            setLoading(false);
        };

        // Show a spinner on payment processing
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                payBtn.disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#buttonText").classList.add("hidden");
            } else {
                // Enable the button and hide spinner
                payBtn.disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#buttonText").classList.remove("hidden");
            }
        }

        // Display message
        function showMessage(messageText) {
            const messageContainer = document.querySelector("#paymentResponse");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 5000);
        }
    </script>

</body>

</html>