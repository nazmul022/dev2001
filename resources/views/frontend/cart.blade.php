@extends('frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('CartUpdate') }}" method="post">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="price">Price</th>
                                    <th class="ptice">Color</th>
                                    <th class="ptice">Size</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grand_total = 0;
                                @endphp
                                @foreach ($abc as $cart)
                                    <tr>
                                        <td class="images"><img src="{{ asset('images/' . $cart->product->thumbnail) }}"
                                                alt="{{ $cart->product->title }}"></td>
                                        <td class="product"><a target="_blank"
                                                href="{{ route('SingleProduct', $cart->product->slug) }}">{{ $cart->product->title }}</a>
                                        </td>
                                        <td class="ptice unite_price{{ $cart->id }}"
                                            data-unite{{ $cart->id }}="{{ $cart->product->price }}">
                                            {{ $cart->product->price }}</td>
                                        <td class="price">{{ $cart->color_id }}</td>
                                        <td class="ptice">{{ $cart->size_id }}</td>
                                        <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" name="quantity[]" class="qty_quantity{{ $cart->id }}"
                                                value="{{ $cart->quantity }}" />
                                            <div class="dec qtybutton ptyminus{{ $cart->id }}">-</div>
                                            <div class="inc qtybutton ptyplus{{ $cart->id }}">+</div>

                                        </td>
                                        @php
                                            $grand_total += $cart->quantity * $cart->product->price;
                                        @endphp
                                        <td class="total tuira total_unite{{ $cart->id }}">
                                            {{ $cart->quantity * $cart->product->price }}</td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                    </ul>
                    </form>
                    <form action="{{ route('Cart') }}" method="get">
                        <h3>Cupon</h3>
                        <p>Enter Your Cupon Code if You Have One</p>
                        <div class="cupon-wrap">
                            <input type="text" value="{{ $code ?? '' }}" name="coupon_code" placeholder="Cupon Code">
                            <button>Apply Cupon</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                <div class="cart-total text-right">
                    <h3>Cart Totals</h3>
                    <ul>
                        <li><span class="pull-left">Sub Total </span>${{ $grand_total }}</li>
                        <li><span class="pull-left">Coupon Discount </span>${{ $coupon_discount }}</li>
                        <li><span class="pull-left grand_total">Grand Total </span
                                class="hasan">{{ $grand_total - $coupon_discount }}৳</li>
                    </ul>
                    <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
    <!-- cart-area end -->
@endsection
@section('footer_js')
    <script>
        $(document).ready(function() {
            @foreach ($abc as $car)
                $('.ptyminus{{ $car->id }}').click(function() {
                    let qty_quantity = $('.qty_quantity{{ $car->id }}').val();
                    let unite_price = $('.unite_price{{ $car->id }}').attr(
                        'data-unite{{ $car->id }}');
                    $('.total_unite{{ $car->id }}').html(qty_quantity * unite_price);
                    let minus_sub_total = (qty_quantity * unite_price);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('/quantity/update') }}",
                        method: 'post',
                        data: {
                            id: '{{ $car->id }}',
                            qty_quantity: qty_quantity,
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });

                    let c = document.querySelectorAll(".tuira")
                    let arr = Array.from(c)
                    let sum = 0;
                    arr.map(item => {
                        sum += parsentInt(item.innerHTML)
                        $('.hasan').html(sum);
                        console.log(typeof parsentInt(item.innerHTML))
                    })

                });

                $('.ptyplus{{ $car->id }}').click(function() {
                    let qty_quantity = $('.qty_quantity{{ $car->id }}').val();
                    let unite_price = $('.unite_price{{ $car->id }}').attr(
                        'data-unite{{ $car->id }}');
                    $('.total_unite{{ $car->id }}').html(qty_quantity * unite_price)
                    // alert(qty_quantity * unite_price)
                    let plus_sub_total = (qty_quantity * unite_price);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('/quantity/update') }}",
                        method: 'post',
                        data: {
                            id: '{{ $car->id }}',
                            qty_quantity: qty_quantity,
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });

                    let c = document.querySelectorAll(".tuira")
                    let arr = Array.from(c)
                    let sum = 0;
                    arr.map(item =>{
                        sum += parsentInt(item.innerHTML)
                        $('.hasan').html(sum);
                        console.log(typeof parsentInt(item.innerHTML))
                    })

                })
            @endforeach
        })
    </script>
@endsection
