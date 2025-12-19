<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Variables */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 16px;
            -webkit-font-smoothing: antialiased;

        }

        form {


            box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
            border-radius: 7px;
            padding: 20px;
        }

        .hidden {
            display: none;
        }

        #payment-message {
            color: rgb(105, 115, 134);
            font-size: 16px;
            line-height: 20px;
            padding-top: 12px;
            text-align: center;
        }

        #payment-element {
            margin-bottom: 24px;
        }

        /* Buttons and links */
        button {
            background: #5469d4;
            font-family: Arial, sans-serif;
            color: #ffffff;
            border-radius: 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        }

        button:hover {
            filter: contrast(115%);
        }

        button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }

        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }

        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 90vw;
                min-width: initial;
            }
        }
        .items{
            display: flex;
            flex-flow: column;
        }
        .pendingItem{
            display: flex;
            justify-content: space-between;
            background-color: #cdcdcd;
            border-radius: 8px;
            padding: 15px;
            margin-top:15px;
        }
        .pendingItem .info{
            margin-left: 15px;
            flex: 0.8;
            display: flex;
            flex-flow: column;
        }
        .pendingItem .img{
            width: 72px;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-8">
        <div class=" md:px-[40px] mx-auto justify-center items-center">
            <img src="https://sehasave.ae/frontend4/images/color-logo.png" width="50%"
                class="max-w-md flex text-center mx-auto px-4 py-8 justify-center items-center" />
            <!-- Display a payment form -->
            <form id="payment-form" class="w-full mx-auto justify-center items-center">
                <div class="grid md:grid-cols-2 gap-4">

                    <!-- <div>
                        <h4 class="font-light">Order ID: #{{ $order['order_id'] }}</h4>
                        <h4 class="font-light">Total: AED {{ number_format($order['total'], 2) }}</h4>
                        <h4 class="font-light">Status: {{ $order['status'] }}</h4>
                    </div> -->
                    <div class="items">
                        @foreach ($order['order_data'] as $or)
                            <div class="pendingItem">
                                <div class="img"><img src="{{ $or['image'] }}" alt="pending image"></div>
                                <div class="info">
                                    <span class="title">{{ $or['title'] }}</span>
                                    <span class="quantity">x {{ $or['quantity'] }}</span>
                                </div>
                                <div class="price">{{ number_format($or['price']) }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- <table class="w-full bg-white py-4  bg-gray-50 rounded-md text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-100 text-gray-800 font-bold uppercase">#</th>
                                <th class="px-6 py-3 bg-gray-100 text-gray-800 font-bold uppercase">Title</th>
                                <th class="px-6 py-3 bg-gray-100 text-gray-800 font-bold uppercase">Price</th>
                                <th class="px-6 py-3 bg-gray-100 text-gray-800 font-bold uppercase">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order['order_data'] as $or)
                                <tr>
                                    <td class="px-6 py-1 whitespace-no-wrap border-b border-gray-300 "><img
                                            src="{{ $or['image'] }}" class="rounded-md w-full md:w-[100px]" /></td>
                                    <td class="px-6 py-1 whitespace-no-wrap border-b border-gray-300 text-sm">
                                        {{ $or['title'] }}
                                    </td>
                                    <td class="px-6 py-1 whitespace-no-wrap border-b border-gray-300 text-sm">
                                        {{ number_format($or['price']) }}</td>
                                    <td class="px-6 py-1 whitespace-no-wrap border-b border-gray-300 text-sm">
                                        {{ $or['quantity'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> -->
                </div>
                <div id="card-element" class="py-4">
                    <!-- Stripe.js will inject the card fields here -->
                </div>

                <button id="submit" class="">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="button-text">Pay now</span>
                </button>
                <div id="payment-message" class="hidden"></div>
            </form>
        </div>
    </div>
</body>
<script>
    // This is a public sample test API key.
    // Don’t submit any personally identifiable information in requests made with this key.
    // Sign in to see your own test API key embedded in code samples.
    const stripe = Stripe("{{ $key }}");


    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const paymentForm = document.getElementById('payment-form');
    paymentForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const result = await stripe.confirmCardPayment(client_secret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: "{{ $name }}",
                    email: "{{ $email }}"
                }
            },
            setup_future_usage: 'off_session'
        });

        if (result.error) {
            console.error(result.error);
            // Handle payment error here
        } else {
            console.log(result.paymentIntent);
            // Payment successful, redirect or show success message
        }

    });
    /*  initialize();
     checkStatus();

     document
         .querySelector("#payment-form")
         .addEventListener("submit", handleSubmit);

     let emailAddress = '{{ $email }}';
     // Fetches a payment intent and captures the client secret
     async function initialize() {

         const clientSecret = '{{ $client_secret }}';
         elements = stripe.elements({
             clientSecret
         });

         const linkAuthenticationElement = elements.create("linkAuthentication");
         linkAuthenticationElement.mount("#link-authentication-element");

         const paymentElementOptions = {
             layout: "tabs",
         };

         const paymentElement = elements.create("payment", paymentElementOptions);
         paymentElement.mount("#payment-element");
     }

     async function handleSubmit(e) {
         e.preventDefault();
         setLoading(true);

         const {
             error
         } = await stripe.confirmPayment({
             elements,
             confirmParams: {
                 // Make sure to change this to your payment completion page
                 return_url: "https://sehasave.ae/inapp/checkout/success?order_id={{ $order['order_id'] }}",
                 receipt_email: emailAddress,
             },
         });

         // This point will only be reached if there is an immediate error when
         // confirming the payment. Otherwise, your customer will be redirected to
         // your `return_url`. For some payment methods like iDEAL, your customer will
         // be redirected to an intermediate site first to authorize the payment, then
         // redirected to the `return_url`.
         if (error.type === "card_error" || error.type === "validation_error") {
             showMessage(error.message);
         } else {
             showMessage("An unexpected error occurred.");
         }

         setLoading(false);
     }

     // Fetches the payment intent status after payment submission
     async function checkStatus() {
         const clientSecret = new URLSearchParams(window.location.search).get(
             "payment_intent_client_secret"
         );

         if (!clientSecret) {
             return;
         }

         const {
             paymentIntent
         } = await stripe.retrievePaymentIntent(clientSecret);

         switch (paymentIntent.status) {
             case "succeeded":
                 showMessage("Payment succeeded!");
                 break;
             case "processing":
                 showMessage("Your payment is processing.");
                 break;
             case "requires_payment_method":
                 showMessage("Your payment was not successful, please try again.");
                 break;
             default:
                 showMessage("Something went wrong.");
                 break;
         }
     }

     // ------- UI helpers -------

     function showMessage(messageText) {
         const messageContainer = document.querySelector("#payment-message");

         messageContainer.classList.remove("hidden");
         messageContainer.textContent = messageText;

         setTimeout(function() {
             messageContainer.classList.add("hidden");
             messageContainer.textContent = "";
         }, 4000);
     }

     // Show a spinner on payment submission
     function setLoading(isLoading) {
         if (isLoading) {
             // Disable the button and show a spinner
             document.querySelector("#submit").disabled = true;
             document.querySelector("#spinner").classList.remove("hidden");
             document.querySelector("#button-text").classList.add("hidden");
         } else {
             document.querySelector("#submit").disabled = false;
             document.querySelector("#spinner").classList.add("hidden");
             document.querySelector("#button-text").classList.remove("hidden");
         }
     } */
</script>

</html>
