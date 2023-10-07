<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Brand;
use App\Color;
use App\Size;
use App\Attribute;
use App\Gallery;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    function products(){
        return view('backend.product.product-list',[
            'products' => Product::paginate(),
            'product_count' => Product::count()
        ]);
    }
    function productAdd(){

        return view('backend.product.product-form',[
            'scat' => SubCategory::orderBy('subcategory_name','asc')->get(),
            'categories' => Category::orderBy('category_name','asc')->get(),
            'brands' => Brand::orderBy('brand_name','asc')->get(),
            'colors' => Color::orderBy('color_name','asc')->get(),
            'sizes' => Size::orderBy('size_name','asc')->get()

        ]);
    }
    function productStore(request $request){
            // return $request->all();
            if($request->hasFile('thumbnail')){
                $image = $request->file('thumbnail');
                $ext = Str::random(5).'.'. $image->getClientOriginalExtension();
                Image::make($image)->resize(500, 385)->save(public_path('images/'. $ext));

            $product_id = Product::insertGetId([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'summary' => $request->summary,
                'description' => $request->description,
                'thumbnail' => $ext,
                'created_at' => Carbon::now()
            ]);

            foreach ($request->color_id as $key => $value) {
                Attribute::insert([

                  'color_id' =>$value,
                  'product_id' =>$product_id,
                  'size_id' =>$request->size_id[$key],
                  'quantity' =>$request->quantity[$key],
                  'created_at' =>Carbon::now()


                ]);

           }

           if($request->hasFile('images')){
            $images = $request->file('images');

            $new_location = public_path('gallery/')
            . Carbon::now()->format('Y/m/')
            . $product_id .'/';
            File::makeDirectory($new_location, $mode = 0777, true, true);
            // die('ok');
            foreach ($images as  $img) {

                $img_ext = Str::random(5).'.'. $img->getClientOriginalExtension();
                Image::make($img)->resize(200, 200)->save($new_location . $img_ext);
                Gallery::insert([
                    'product_id' => $product_id,
                    'images' => $img_ext,
                    'created_at' => Carbon::now()
                ]);
            }

           }
            return back();
            }


    }
    function ProductEdit($slug){
        return view('backend.product.product-edit',[
            'brands' => Brand::all(),
            'categories' => Category::all(),
            // 'scat' => SubCategory::all(),
            'product' => Product::where('slug', $slug)->first()
        ]);
    }
    function productUpdate(request $request){
    //    $request->validate([
    //         'thumbnail' => ['required','image']
    //    ]);
       $product = Product::findOrFail($request->product_id);
    //    for thumbnail dedicated foolder
    // img_location = public_path($product->created_at()->format('Y/m').$product->id.'/'.$product->thumbnail);
    if($request->hasFile('thumbnail')){
        $image = $request->file('thumbnail');
        $ext = Str::random(5).'.'. $image->getClientOriginalExtension();
            $old_img_location = public_path('images/'.$product->thumbnail);
            if(file_exists($old_img_location)){
            unlink($old_img_location);
        }
        Image::make($image)->resize(200, 200)->save(public_path('images/'. $ext));
        $product->thumbnail = $ext;
    }
            $product->title = $request->title;
            $product->price = $request->price;
            $product->slug = Str::slug($request->title);
            $product->summary = $request->summary;
            $product->description = $request->description;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->save();
                return "productUpdate";
        }

    function CategoryAjax($id){
        $scat = SubCategory::where('category_id', $id)->get();
        return response()->json($scat);
    }
    function ProductImageEdit($slug){
         $product_id = Product::where('slug',$slug)->first();
        $gallery = Gallery::where('product_id',$product_id->id)->get();
        return view('backend.product.product-image-edit',[
            'gallery' => $gallery,
            'product_id' => $product_id->id
        ]);
    }
    function GalleryImageDelete($id){
        $Gallery = Gallery::findOrFail($id);
        $old_gallery_img = public_path('gallery/'.$Gallery->created_at->format('Y/m/').$Gallery->product_id.'/'.$Gallery->images);
        if(file_exists($old_gallery_img)){
            unlink($old_gallery_img);
            $Gallery->delete();
            return back();
        }
    }
    function MultiImaUpdate(request $request){

        if($request->hasFile('images')){
            $product_id = $request->product_id;
            $images = $request->file('images');

            $new_location = public_path('gallery/')
            . Carbon::now()->format('Y/m/')
            . $product_id .'/';
            File::makeDirectory($new_location, $mode = 0777, true, true);
            // die('ok');
            foreach ($images as  $img) {

                $img_ext = Str::random(5).'.'. $img->getClientOriginalExtension();
                Image::make($img)->resize(500, 500)->save($new_location . $img_ext);

                // Gallery::insert([
                //     'product_id' => $product_id,
                //     'images' => $img_ext,
                //     'created_at' => Carbon::now()
                // ]);
                $nazmul = new Gallery;
                $nazmul->product_id = $product_id;
                $nazmul->images = $img_ext;
                $nazmul->save();
            }
            return back();
           }
    }
    function ProductDelete($id){
        $product = Product::findOrFail($id);
        $old_gallery_img = public_path('images/'.$product->thumbnail);
        if(file_exists($old_gallery_img)){
            unlink($old_gallery_img);
            // return back();
            // return "Thumbnail ache.";
        }

        $gallery = Gallery::where('product_id',$product->id)->get();
        foreach ($gallery as  $item) {
            $oldimg = public_path('gallery/'.$item->created_at->format('Y/m/').$item->product_id.'/'.$item->images);
            if(file_exists($oldimg)){
                unlink($oldimg);
                $item->delete();
                // return back();
                // return "gallery image ache.";
            }
        }
        $product->delete();
       return "Deleted successfully!";
    }

}
