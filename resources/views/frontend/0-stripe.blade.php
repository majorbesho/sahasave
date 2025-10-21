@extends('frontend.layouts.master')

@section('content')


    <div class="container  payment-details">
        <div class="row"
            style="position:relative; margin-bottom: 40px;box-shadow: 0 2px 6px 2px rgb(141 141 141 / 45%);border-radius: 8px;margin-top: 75px;overflow:hidden;">
            <div class="secureBanner">
                <div>
                    <i class="fas fa-lock mr-2"></i>
                    <span>Secure Checkout</span>
                </div>
                <span style="font-size: 15px;">Enter details to complete purchase.</span>
            </div>
            <div class="row" style="margin-top: 8rem;">
                <div class="col-lg-6 p-0">
                    <div class="container form-containercart">
                        <div class="col-12">

                            {{--  {{ route('stripe.post') }} --}}
                            {{-- <form id="payment-form" role="form" action="stripe.post" method="post" class="require-validation"
                                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PUBLISHABLE_KEY') }}"
                                id="payment-form"> --}}

                            <form method="POST" action="{{ route('stripe.post') }}">
                                @csrf
                                @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                                    @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                        <input type="hidden" name="" value="{{ $item->name }}">
                                        <input type="hidden" name="qty" value="{{ $item->qty }}">
                                        <input type="hidden" name="product_type" value="{{ $item->product_type }}">

                                        <input type="hidden" name="" value="{{ $item->id }}">
                                        <input type="hidden" name="" value="{{ $item->price }}">
                                    @endforeach
                                    <input type="hidden" name="" value="{{ Cart::subtotal() }}">
                                @endif
                                <div class="row paydetails">
                                    <h6 class="smallHeading" style="cursor:pointer;" onclick="history.back()">Back</h6>
                                    <h6 class="smallHeading">Information > Checkout</h6>
                                    <hr class="mt-3">
                                    <div class='row py-5 paydetails required '>
                                        <label class='control-label black-lable'>Promo Code </label>
                                        <input class='form-control' type='text' id="empid" name="empid"
                                            placeholder="Enter Your Promo Code (Optional )">
                                    </div>
                                    <h5 class="mb-3">Payment Details</h5>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label black-lable'>Name on Card</label>
                                        <input class='form-control' size='4' type='text'>
                                    </div>


                                    <div id="card-element" class="py-4">
                                        <!-- Stripe.js will inject the card fields here -->
                                    </div>

                                    <div class='form-row row stripeRow'>
                                        <div class='col-xs-12 form-group required p-0 m-0'>
                                            <label class='control-label black-lable'>Card Information</label>
                                            <input autocomplete='off'
                                                class='paymentInput form-control card-number borderTop'
                                                placeholder='1234 1234 1234 1234' size='16' type='text'
                                                maxlength="16">
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required p-0'>
                                            <!--<label class='control-label black-lable'>Expiration Month</label>-->
                                            <input class='paymentInput form-control card-expiry-month borderBottomLeft'
                                                placeholder='MM' size='2' type='text' maxlength="2">
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required p-0'>
                                            <!--<label class='control-label black-lable'>Expiration Year</label>-->
                                            <input class='paymentInput form-control card-expiry-year rounded-0 noBorderTop'
                                                placeholder='YYYY' size='4' type='text' maxlength="4">
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group cvc required p-0'>
                                            <!--<label class='control-label black-lable'>CVC</label>-->
                                            <input autocomplete='off'
                                                class='paymentInput form-control card-cvc borderBottomRight'
                                                placeholder='CVC' size='4' type='text' maxlength="3">
                                        </div>
                                    </div>
                                </div>
                                {{-- <button id="submit" class="">
                                    <div class="spinner hidden" id="spinner"></div>
                                    <span id="button-text">Pay now</span>
                                </button> --}}
                                {{-- <div id="payment-message" class="hidden"></div> --}}
                                <div class="bottom-buttons">
                                    <div class="proceed">
                                        <button type="submit" name="novouchar" value="novouchar"
                                            class="proceed-button">Proceed</button>
                                    </div>
                                </div>
                                {{-- <div class="bottom-buttons">
                                    <div class="proceed">
                                        <a href="{{route('stripe.get.v')}}" type="submit" name="vouchar" value="vouchar" class="proceed-button" >Proceed as voucher  </a>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12 center">
                                    <img src="{{ asset('frontend4/images/download.png') }}" alt="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0 totalcart">
                    <div class="w-85">
                        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                <div class="col-12 text-start ps-5 cartItem">
                                    <div class="itemImg">
                                        @php
                                            $photos = explode(',', $item->model->photo);
                                        @endphp
                                        <img src="{{ $photos[0] }}" alt="image">
                                    </div>
                                    <div class="itemInfo">
                                        <div class="name">{{ $item->name }}</div>
                                        <div class="qty">x{{ $item->qty }}</div>
                                    </div>
                                    <div class="itemPrice">{{ $item->price }} AED</div>
                                </div>
                            @endforeach
                            <div class="col-12 text-end">
                                <p class="product-payment">Total </p>
                                <p class="price-payment"> {{ Cart::subtotal() }} AED</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="inner-hero-section d-none">

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <div class="container form-container">
            <div class="col-12">
                {{-- <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PUBLISHABLE_KEY') }}"
                    id="payment-form">
                    @csrf



                    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                            <input type="hidden" name="" value="{{ $item->name }}">
                            <input type="hidden" name="qty" value="{{ $item->qty }}">
                            <input type="hidden" name="qty" value="{{ $item->product_type }}">

                            <input type="hidden" name="" value="{{ $item->id }}">
                            <input type="hidden" name="" value="{{ $item->price }}">
                        @endforeach
                        <input type="hidden" name="" value="{{ Cart::subtotal() }}">
                    @endif


                    <div class="col-12  payment-overview">
                        <p class="product-payment">Amount To Pay </p>
                        <p class="price-payment">{{ Cart::subtotal() }}</p>

                    </div>



                    <div class="row py-5 paydetails">
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label black-lable'>Name on Card</label>
                            <input class='form-control' size='4' type='text'>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group  required'>
                                <label class='control-label black-lable'>Card Number</label> <input autocomplete='off'
                                    class='form-control card-number' size='20' type='text' maxlength="16">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label black-lable'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                    size='4' type='text' maxlength="">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label black-lable'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label black-lable'>Expiration Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-buttons">
                        <div class="proceed">
                            <button type="submit" class="proceed-button">Proceed</button>
                        </div>
                    </div>
                    <div class="bottom-buttons">
                        <div class="proceed">
                            <button type="submit" class="proceed-button">Proceed as voucher </button>
                        </div>
                    </div>


                </form> --}}
            </div>

        </div>



    </section>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script>
        This is a public sample test API key.
        Don’ t submit any personally identifiable information in requests made with this key.
        Sign in to see your own test API key embedded in code samples.
        const stripe = Stripe("{{ $key }}");


        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
        const client_secret = '{{ $client_secret }}';
        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            setLoading(true);
            showMessage("Your payment is processing.");

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
                setLoading(false);
                showMessage(`Something went wrong ${result.error}`);
                // Handle payment error here
            } else {
                // console.log(result);
                showMessage("Payment succeeded!");
                var csrfToken = '{{ csrf_token() }}';
                var data = {
                    empid: $("#empid").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                // Make the AJAX POST request
                $.ajax({
                    url: "https://USahaSave.com/stripe",
                    type: "POST",
                    data: JSON.stringify(data), // Convert data to JSON string
                    contentType: "application/json; charset=utf-8", // Set Content-Type header to JSON
                    dataType: "json", // Expect JSON response from the server
                    success: function(response) {
                        console.log(response); // Handle success response
                        window.location.href = response.redirect_url;
                        setLoading(false);
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle error response
                        //alert(error)
                        setLoading(false);
                        showMessage(`Something went wrong ${result.error}`);
                    }
                });
                // Payment successful, redirect or show success message
            }

        });

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
        }
    </script>
    {{-- <script type="text/javascript">
        $(function() {

                    /*------------------------------------------
                    --------------------------------------------
                    Stripe Payment Code
                    --------------------------------------------
                    --------------------------------------------*/

                    var $form = $(".require-validation");

                    $('form.require-validation').bind('submit', function(e) {
                        var $form = $(".require-validation"),
                            inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'
                            ].join(', '),
                            $inputs = $form.find('.required').find(inputSelector),
                            $errorMessage = $form.find('div.error'),
                            valid = true;
                        $errorMessage.addClass('hide');

                        $('.has-error').removeClass('has-error');
                        $inputs.each(function(i, el) {
                            var $input = $(el);
                            if ($input.val() === '') {
                                $input.parent().addClass('has-error');
                                $errorMessage.removeClass('hide');
                                e.preventDefault();
                            }
                        });

                        if (!$form.data('cc-on-file')) {
                            e.preventDefault();
                            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                            Stripe.createToken({
                                number: $('.card-number').val(),
                                cvc: $('.card-cvc').val(),
                                exp_month: $('.card-expiry-month').val(),
                                exp_year: $('.card-expiry-year').val()
                            }, stripeResponseHandler);
                        }

                    });

                    /*------------------------------------------
                    --------------------------------------------
                    Stripe Response Handler
                    --------------------------------------------
                    --------------------------------------------*/
                    function stripeResponseHandler(status, response) {
                        if (response.error) {
                            $('.error')
                                .removeClass('hide')
                                .find('.alert')
                                .text(response.error.message);
                        } else {
                            /* token contains id, last4, and card type*/
                            var token = response['id'];

                            $form.find('input[type=text]').empty();
                            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                            $form.get(0).submit();
                        }
                    }

                });
    </script> --}}
@endsection
