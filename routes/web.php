<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogedIn;
use App\Http\Middleware\CheckLogedOut;

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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/admin/file-manager',function(){
    return view('backend.layouts.file-manager');
})->name('file-manager');


//Product
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('product-detail/{slug}', 'ProductController@productDetail')->name('product-detail');
    Route::post('/product/search', 'ProductController@productSearch')->name('product.search');
    Route::get('/product-cat/{slug}', 'ProductController@productCat')->name('product-cat');
    Route::get('/product-sub-cat/{slug}/{sub_slug}','ProductController@productSubCat')->name('product-sub-cat');
    Route::get('/product-brand/{slug}', 'ProductController@productBrand')->name('product-brand');

    Route::get('/product-grids', 'ProductController@productGrids')->name('product-grids');
    Route::get('/product-lists', 'ProductController@productLists')->name('product-lists');
    Route::match(['get','post'], '/filter', 'ProductController@productFilter')->name('shop.filter');

    // Product Review
    Route::resource('/review', 'ProductReviewController');
    Route::post('product/{slug}/review', 'ProductReviewController@store')->name('review.store');
});   


// Blog
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/blog', 'BlogController@blog')->name('blog');
    Route::get('/blog-detail/{slug}', 'BlogController@blogDetail')->name('blog.detail');
    Route::get('/blog/search', 'BlogController@blogSearch')->name('blog.search');
    Route::post('/blog/filter', 'BlogController@blogFilter')->name('blog.filter');
    Route::get('blog-cat/{active}', 'BlogController@blogByCategory')->name('blog.category');
    Route::get('blog-tag/{slug}', 'BlogController@blogByTag')->name('blog.tag');

    // NewsLetter
    Route::post('/subscribe', 'BlogController@subscribe')->name('subscribe');
    
    // Post Comment 
    Route::post('post/{slug}/comment', 'PostCommentController@store')->name('post-comment.store');
    Route::resource('/comment', 'PostCommentController');

    // Like Or Dislike
    Route::post('save-likedislike','LikeController@saveLikeDislike')->middleware('web');
}); 



// Client Routes
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'FrontendController@home')->name('home');

    // Socialite 
    Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
    Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

    // Frontend Routes
    Route::get('/home', 'FrontendController@index');
    Route::get('/about-us', 'FrontendController@aboutUs')->name('about-us');

    Route::get('/contact', 'ContactController@contact')->name('contact');
    Route::post('/contact/create', 'ContactController@store')->name('contact.store');


    Route::middleware([CheckLogedOut::class])->group(function () {
        Route::get('/admin/contact/list', 'ContactController@index')->name('contact.admin.index');
        Route::post('/admin/contact/feeback', 'ContactController@feeback')->name('contact.admin.feeback');
        Route::get('/admin/contact/delete', 'ContactController@store')->name('contact.admin.destroy');
    });

    // Wishlist
    Route::get('wishlist',function(){
        return view('frontend.pages.wishlist');
    })->name('wishlist');
    Route::get('wishlist/{slug}', 'WishlistController@wishlist')->name('add-to-wishlist');//->middleware('user');
    Route::get('wishlist-delete/{id}', 'WishlistController@wishlistDelete')->name('wishlist-delete');

    // Coupon
    Route::post('/coupon-store', 'CouponController@couponStore')->name('coupon-store');
});
















//=======================================================================================
// Payment
// Route::group(['namespace' => 'Frontend'], function () {
//     Route::get('payment', 'PayPalController@payment')->name('payment');
//     Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
//     Route::get('payment/success', 'PayPalController@success')->name('payment.success');
// });



//Cart - Order
// Route::group(['namespace' => 'Frontend'], function () {
//     //Order
//     Route::post('cart/order','OrderController@store')->name('cart.order');
//     Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
//     Route::get('/income','OrderController@incomeChart')->name('product.order.income');
//     // Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
// }); 




