<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\support\Str;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    function __construct(){
        $this->middleware('verified');
    }
    function CategoryList(){
        $categories = Category::Paginate(20);

        return view('backend.category.category-list',[
            'categories' => $categories
        ]);
    }
    function CategoryAdds(){
        return view('backend.category.category-add');
    }
    Function CategoryTrash(){
        $trash_category = Category::onlyTrashed()->get();
        return view('backend.category.trashed-category',[
            'trash_category' => $trash_category
        ]);
    }
    function CategoryPost(request $req){
        // $req->validate([
        //     'category_name' => ['required','min:3','unique:categories',"regex:/^[a-zA-Z0-9$# \-]*$/"]
        // ],[
        //     'category_name.required' => 'Plese Enter your name!',
        //     'category_name.unique' =>'This name is already exist!',
        // ]);

        $data = new Category;
        $data->slug = Str::slug($req->category_name);
        $data->category_name = $req->category_name;
        $data->save();
        return back()->with('CategoryAdd','Category added successfully!');
            // Category::insert([
            //      db column field => form request value
            //     'category_name' => $req->category_name
            // ]);
    }
    function CategoryDelete($id){
        $cat_product = Product::where('category_id',$id)->count();
        if($cat_product> 0){
            return back()->with('hproduct',"You can't delete this category.");
        }else{
            Category::findOrFail($id)->delete();
        return back()->with('nproduct', "Category deleted successfully!");
        }
    }
    function CategoryRestore($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return back();
    }
    function CategoryParmanent($id){
        Category::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('CategoryParmanent','Category permanent deleted successfuly!');;
    }
    function CategoryEdit($id){
        $categories = Category::Paginate(3);
        $trash_category = Category::onlyTrashed()->get();
        $edit_categroy = Category::FindOrFail($id);

        return view('backend.category.category-edit',[
            'categories' => $categories,
            'trash_category' => $trash_category,
            'edit_category' => $edit_categroy
        ]);
        return redirect('/category-list');
    }
    function CategoryUpdate(request $req){
        // Category::FindOrFail($req->id)->update([
        //     'category_name' => $req->category_name,
        //     'slug' => Str::slug($req->category_name),
        //     'updated_at' => Carbon::now()
        // ]);
        $update = Category::FindOrFail($req->id);
        $update->category_name = $req->category_name;
        $update->slug = Str::slug($req->category_name);
        $update->save();
        return back();
    }
    function SelectedCategoryDelete(request $request){
        if($request->cat_id != ''){
            foreach ($request->cat_id as  $cat) {
                Category::findOrFail($cat)->delete();
            }
        }
        return back();
    }
}
