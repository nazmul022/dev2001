<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Gallery;
use App\Attribute;
use App\Category;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Blog;
use App\Cart;
use App\Comment;
use App\Review;

class FrontendController extends Controller
{
    function front(){

        return view('frontend.main',[
            'products' => Product::latest()->limit(10)->get(),
        ]);
    }
    function SingleProduct($slug){
        $product = Product::where('slug',$slug)->first();
        $gallery = Gallery::where('product_id', $product->id)->get();
        $attribute = Attribute::where('product_id', $product->id)->get();
        $collection = collect($attribute);
        $groupBy = $collection->groupBy('color_id');
        return view('frontend.single_product',[
            'product' => $product,
            'gallery' => $gallery,
            'attribute' => $attribute,
            'groupBy' => $groupBy,
            'reviews' => Review::where('product_id',$product->id)->get(),
        ]);
        // return abort(404);
    }
    function GetSize($color, $product){
        $output = '';
        $sizes = Attribute::where('color_id', $color)->where('product_id', $product)->get();
        foreach($sizes as $size){
            $output = $output. '<input name="size_id" type="radio" value="'.$size->size_id.'" >'.$size->size->size_name.'';
        }
       echo $output;
    }
    function blogs(){
        return view('frontend.blogs',[
            'blogs' =>Blog::latest()->paginate(3)
        ]);
    }
    function SingleBlog($slug){
        $category = Category::orderBy('category_name','asc')->get();
        $blog = Blog::whereSlug($slug)->first();
        return view('frontend.blog_details',[
            'blog' => $blog,
            'category' => $category,
            'related' => Blog::where('category_id',$blog->category_id)->get()->except(['id', $blog->id]),
            'comments' => Comment::where('status', 2)->where('blog_id',$blog->id)->latest()->get(),
        ]);
    }
    function Qupdate(Request $request){
         $id = $request->id;
        $q = $request->qty_quantity;

        $cart = Cart::findOrFail($id);
        $cart->quantity = $q;
        $cart->save();

        return response()->json("OK");
    }
    function search(Request $request){
        $product = Product::query();

        if ($request->q)
        {
           // simple where here or another scope, whatever you like
           $product->orwhere('title','like',$request->q);
        }

        if ($request->q)
        {
            $product->orwhere('price','like',$request->q);
        }

        if ($request->q)
        {
            $product->orwhere('slug','like',$request->q);
        }
        return $all_product = $product->get();
    }



}
