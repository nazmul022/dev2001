<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/about',function(){
    $about = "This is my about page";
    $about = 5+6;
    return view('about', compact('about'));
    return view('about', [
        'ab' => $about,
    ]);
});
Route::get('/','FrontendController@front')->name('front');
Route::get('/single/{slug}','FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/checkout','CheckoutController@Checkout')->name('Checkout');
Route::get('/api/get-state-list/{id}','CheckoutController@GetState')->name('GetState');
Route::get('/api/get-city-list/{id}','CheckoutController@GetCity')->name('GetCity');

Route::get('about','TestController@about');
Route::get('maya','TestController@maya');
Route::get('form','TestController@form');
Route::get('my-portfolio','TestController@MyPortfolio')->name('MyPortfolio');
Route::get('/jannat',function(){
    return view('pages/jannat');
});
Route::get('person','PersonController@person');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@index')->name('users');

// Category

Route::get('/category-list', 'CategoryController@CategoryList')->name('CategoryList');
Route::get('/trashed-category', 'CategoryController@CategoryTrash')->name('CategoryTrash');
Route::post('/category-post', 'CategoryController@CategoryPost')->name('CategoryPost');
Route::get('/category-add', 'CategoryController@CategoryAdds')->name('CategoryAdds');
Route::get('/category/delete/{id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');
Route::get('/category-restore/{id}', 'CategoryController@CategoryRestore')->name('CategoryRestore');
Route::get('/category-parmanent/{id}', 'CategoryController@CategoryParmanent')->name('CategoryParmanent');
Route::get('/category/edit/{id}','CategoryController@CategoryEdit')->name('CategoryEdit');
Route::post('/category-update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');
Route::post('/selected/category/delete', 'CategoryController@SelectedCategoryDelete')->name('SelectedCategoryDelete');

// sub caregory

Route::get('/subcategory-view', 'SubCategoryController@SubCategoryView')->name('SubCategoryView');
Route::get('/subcategory-form', 'SubCategoryController@SubCategoryForm')->name('SubCategoryForm');
Route::post('/subcategory-post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');
Route::get('/subcategory-edit/{scat_id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');
Route::post('/subcategory-update', 'SubCategoryController@SubCategoryUpdate')->name('SubCategoryUpdate');

// users route
Route::get('users','HomeController@users')->name('users');
// Order
Route::get('orders/','HomeController@Orders')->name('Orders');
Route::get('orders/pdf/download','HomeController@PdfDownload')->name('PdfDownload');
Route::get('orders/excel/download','HomeController@ExcelDownload')->name('ExcelDownload');
Route::post('/orders/exel/imports', 'HomeController@import')->name('import');
Route::post('/orders/exel/selected/date', 'HomeController@SelectedDateExcelDawnload')->name('SelectedDateExcelDawnload');
// product route
Route::get('products/','ProductController@products')->name('products');
Route::get('product/Add','ProductController@productAdd')->name('productAdd');
Route::get('product/edit/{slug}','ProductController@ProductEdit')->name('ProductEdit');
Route::get('product/image/edit/{slug}','ProductController@ProductImageEdit')->name('ProductImageEdit');
Route::post('product/store','ProductController@productStore')->name('productStore');
Route::post('product/update','ProductController@productUpdate')->name('productUpdate');
Route::get('product/delete/{id}','ProductController@productDelete')->name('productDelete');
// Ajax
Route::get('category/ajax/{id}','ProductController@CategoryAjax')->name('CategoryAjax');
// Gallery
Route::get('gallery-image-delete/{id}','ProductController@GalleryImageDelete')->name('GalleryImageDelete');
Route::post('gallery-image-update','ProductController@MultiImaUpdate')->name('MultiImaUpdate');
// Color wise size
Route::get('product/get/size/{color}/{product}','FrontendController@GetSize')->name('GetSize');
// Add to cart
Route::post('add-to-cart','CartController@addToCart')->name('addToCart');
Route::post('cart/update','CartController@CartUpdate')->name('CartUpdate');
Route::get('/cart-page','CartController@Cart')->name('Cart');
// Route::get('get/coupon/discount','CartController@CouponValue')->name('CouponValue');

// payment
Route::post('/payment','PaymentController@Payment')->name('Payment');
Route::get('/payment','PaymentController@getPaymentStatus')->name('getPaymentStatus');
// Role manager
// Route::get('/role-manager','RoleController@role')->name('role');
Route::post('Role-Add-To-Permission','RoleController@RoleAddToPermission')->name('RoleAddToPermission');
Route::post('Role-Add-To-User','RoleController@RoleAddToUser')->name('RoleAddToUser');
// GitHub
Route::get('login-with-github','SocialController@loginWithGithub')->name('loginWithGithub');
Route::get('github-callback-url','SocialController@GithubCallBack')->name('GithubCallBack');
// Google
Route::get('login-with-google','SocialController@loginWithGoogle')->name('loginWithGoogle');
Route::get('callback-url','SocialController@GoogleCallBack')->name('GoogleCallBack');
Route::get('/search','FrontendController@search')->name('search');
// Blog

Route::post('/quantity/update','FrontendController@Qupdate')->name('Qupdate');
Route::post('/comments','HomeController@Comments')->name('Comments');
Route::get('/blogs','FrontendController@blogs')->name('blogs');



Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('blog', 'BlogController');
    Route::get('/role-manager','RoleController@role')->name('role');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(400);
    }

    App::setLocale($locale);

    return back();
})->name('lang');
Route::get('/article/{slug}','FrontendController@SingleBlog')->name('SingleBlog');
Route::post('/products/review','HomeController@UserReview')->name('UserReview');




