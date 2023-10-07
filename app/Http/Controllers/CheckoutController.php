<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\cart;
use App\State;
use App\city;
use App\Country;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function Checkout(){
        $cookie = Cookie::get('cookie_id');
        $carts = cart::where('cookie_id', $cookie)->get();
        $countries = Country::orderBy('name','asc')->get();
        $cities = City::orderBy('name','asc')->get();
        return view('frontend.checkout',[
            'carts' => $carts,
            'cookie' => $cookie,
            'countries' => $countries,
            'cities' => $cities
        ]);
    }
    function GetState($id){
        $states = State::where('country_id',$id)->get();
        return response()->json($states);

    }
    function GetCity($id){
        $cities = City::where('state_id',$id)->get();
        return response()->json($cities);

    }
}
