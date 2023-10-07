<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Cart;
use App\coupon;
use Carbon\Carbon;

class CartController extends Controller
{
    function addToCart(request $request){
        $cookie = Cookie::get('cookie_id');
        if($cookie){
                $unique = $cookie;
        }else{
            $unique = Str::random(7).rand(1,1000);
            Cookie::queue('cookie_id', $unique, 43200);
        }
        $exists = cart::where('cookie_id', $unique)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id);
        if($exists->exists()){
            $exists->increment('quantity', $request->quantity);
        }else{
            $cart = new cart;
            $cart->cookie_id = $unique;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();
        }
    }
    function Cart(request $request){
            $coupon_discount = 0;
            $code = $request->coupon_code;
        if($code == ''){

            $cookie = Cookie::get('cookie_id');
        return view('frontend.cart',[
            'abc' =>cart::where('cookie_id', $cookie)->get(),
            'coupon_discount' => $coupon_discount
        ]);

        }else{
            $cookie = Cookie::get('cookie_id');
            if(coupon::where('code', $code)->exists()){
                $carts = cart::where('cookie_id', $cookie)->get();
                $valid_date =  coupon::where('code', $code)->first();
                if(Carbon::now()->format('Y-m-d') <= $valid_date->validity){

                    if($valid_date->level == 'amount'){
                        $coupon_discount = $valid_date->discount;
                    }else{
                        $total = 0;
                        foreach ($carts as  $cat) {
                            $total += $cat->product->price * $cat->quantity;
                        }
                        $coupon_discount = ($total / 100) * $valid_date->discount;
                    }
                }else{
                    return "Coupon is Invalid";
                }
            }else{
                return "Coupon desn't exiest";
            }
        return view('frontend.cart',[
            //
            'abc' => $carts,
            'coupon_discount' => $coupon_discount,
            'code' => $code,
        ]);

        }


    }
    function CartUpdate(request $request){
        foreach ($request->cart_id as $key=> $data) {
            $cart = cart::findOrFail($data);
            $cart->quantity = $request->quantity[$key];
            $cart->save();
        }

        return back();
    }
//     function CouponValue(){
//         return "CouponValue";

// }
}
