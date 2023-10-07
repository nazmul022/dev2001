@extends('frontend.master')
@section('title')
    Checkout Product | Mr Helthey Recipe
@endsection
@section('checkout')
    active
@endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <style>
        .StripeElement{
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus{
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid{
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="{{ route('Payment') }}" method="post" id="payment-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>First Name *</p>
                                    <input type="text" name="first_name">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Last Name *</p>
                                    <input type="text" name="last_name">
                                </div>
                                <div class="col-12">
                                    <p>Company Name</p>
                                    <input type="text" name="company">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select name="country_id" id="country_id">
                                        <option value>Select One</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>State *</p>
                                    <select name="state_id" id="state_id"></select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select name="city_id" id="city_id"></select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="zipcode">
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address">
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @php
                                $grand_total = 0;
                            @endphp
                        @foreach ($carts as $cart)
                        @php
                            $grand_total += $cart->product->price * $cart->quantity;
                        @endphp
                        <li>{{ $cart->product->title }}<span class="pull-right">{{ $cart->product->price }}৳</span></li>
                        @endforeach


                            <li>Subtotal <span class="pull-right"><strong>$380.00</strong></span></li>
                            <li>Shipping <span class="pull-right">Free</span></li>
                            <li>Total<span class="pull-right">{{ $grand_total }}৳</span></li>
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input id="bank" value="bank" type="radio" name="payment">
                                <label for="bank">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input id="paypal" value="paypal" type="radio" name="payment">
                                <label for="paypal">PayPal</label>
                            </li>
                            <li>
                                <input id="card" value="card" type="radio" name="payment">
                                <label for="card">Credit Card</label>
                            </li>
                            {{-- <label for="card-element">
                                 Cradit or Dabit Card
                              </label>
                              <div id="card-element">
                                <!-- Elements will create input elements here -->
                              </div>

                              <!-- We'll put the error messages in this element -->
                              <div id="card-errors" role="alert"></div> --}}
                            <li>
                                <input id="delivery" value="delivery" type="radio" name="payment">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->

@endsection
@section('footer_js')
<script src="//js.stripe.com/v3/"></script>
<script>
    $('#country_id').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-state-list')}}/"+countryID,
                success:function(res){
                if(res){
                    $("#state_id").empty();
                    $("#state_id").append('<option>Select State</option>');
                    $.each(res,function(key,value){
                        $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }else{
                    $("#state_id").empty();
                }
                }
                 });
                }else{
                    $("#state_id").empty();
                    $("#city_id").empty();
                }
                });
            $('#state_id').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                type:"GET",
                url:"{{url('api/get-city-list')}}/"+stateID,
                success:function(res){
                if(res){
                    $("#city_id").empty();
                    $("#city_id").append('<option>Select State</option>');
                    $.each(res,function(key,value){
                        $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }else{
                    $("#city_id").empty();
                    }
                }
                });
                }else{
                $("#city_id").empty();
                }

        });

            // Stripe Js code

            // Set your publishable key: remember to change this to your live publishable key in production
            // See your keys here: https://dashboard.stripe.com/apikeys
            var stripe = Stripe('pk_test_51NosPMA8EV9yyv5i2RdVtpuNnQYHlQjJIWUDUYVFqycphgQfYk2Rz7a9eVwvhz55aOVwotcuJ6p692JRKzfuyxgp00eg0Fd8FZ');
            var elements = stripe.elements();

            // Set up Stripe.js and Elements to use in checkout form
            var elements = stripe.elements();
            var style = {
            base: {
                color: "#32325d",
            }
            };

            var card = elements.create("card", { style: style });
            card.mount("#card-element");

            card.on('change', ({error}) => {
            let displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
            });


            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            // If the client secret was rendered server-side as a data-secret attribute
            // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                card: card,
                billing_details: {
                    name: 'Jenny Rosen'
                }
                }
            }).then(function(result) {
                if (result.error) {
                // Show error to your customer (for example, insufficient funds)
                console.log(result.error.message);
                } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    // Show a success message to your customer
                    // There's a risk of the customer closing the window before callback
                    // execution. Set up a webhook or plugin to listen for the
                    // payment_intent.succeeded event that handles any business critical
                    // post-payment actions.
                }
                }
            });
            });

            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event){
                event.preventDefault();
                stripe.createToken(card).then(function(result){
                    if(result.error){
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    }else{
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token){
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name','stripeToken');
                hiddenInput.setAttribute('value',token.id);
                form.appendChild(hiddenInput);

                // Submit the form

                form.submit();
            }
</script>
@endsection
