<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    function SubCategoryView(){
        $scategories = SubCategory::with('get_category')->paginate();
        return view('backend.subcategory.subcategory-view',[
            'scategories' => $scategories
        ]);
    }
    function SubCategoryForm(){
        return view('backend.subcategory.subcategory_add',[
            'categories' => Category::OrderBy('category_name','asc')->get()
        ]);
    }
    function SubCategoryPost(request $req){
        SubCategory::insert([
            'subcategory_name' => $req->subcategory_name,
            'slug' => Str::slug($req->subcategory_name),
            'category_id' => $req->category_id,
            'created_at' => Carbon::now(),
        ]);
        return redirect('subcategory-view');
    }
    function CategoryList(){
        $scategories = SubCategory::Paginate(3);

        return view('backend.subcategory.category-view',[
            'categories' => $categories
        ]);
    }
    function SubCategoryEdit($scat_id){
        $scat =  SubCategory::where('slug', $scat_id)->first();

        return view('backend.subcategory.subcategory_edit',[
            'scat' => $scat, 'categories' => Category::OrderBy('category_name','asc')->get()
        ]);
    }
    function SubCategoryUpdate(request $req){
        // Category::FindOrFail($req->id)->update([
        //     'category_name' => $req->category_name,
        //     'slug' => Str::slug($req->category_name),
        //     'updated_at' => Carbon::now()
        // ]);
        $update = SubCategory::FindOrFail($req->id);
        $update->category_name = $req->category_name;
        $update->slug = Str::slug($req->category_name);
        $update->save();
        return back();
    }

}
