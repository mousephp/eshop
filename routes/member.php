<?php

use App\Http\Middleware\CheckMemberLogin;

//=============Member===============//
Route::group(['namespace' => 'Member'], function () {
    //login
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('member/login', 'LoginController@login')->name('login.form');
        Route::post('member/login', 'LoginController@loginSubmit')->name('login.submit');
    });

    //register
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('member/register', 'RegisterController@register')->name('register.form');
        Route::post('member/register', 'RegisterController@registerSubmit')->name('register.submit');
        Route::get('register/verify/{code}', 'RegisterController@verify')->name('register.verify');
    });

    //Logout
    Route::get('member/logout', 'MemberController@logout')->name('member.logout');

    Route::middleware([CheckMemberLogin::class])->group(function () {
        //Dashboard
        Route::get('member', 'HomeController@index')->name('member.dashboard');

        //Profile
        Route::get('member/profile', 'MemberController@profile')->name('member.profile');
        Route::put('member/profile/{id}', 'MemberController@profileUpdate')->name('member.profile.update');

        // Password Change
        Route::get('member/change-password', 'MemberController@changePassword')->name('member.change.password.form');
        Route::put('member/change-password', 'MemberController@changPasswordStore')->name('member.change.password');
    });
});

//forgot-password
Route::group(['namespace' => 'Member'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('forgot-password', 'ForgotPasswordController@getEmailForm')->name('forgot-password');
        Route::post('forgot-password', 'ForgotPasswordController@postEmail');
        Route::get('reset-password/{token}', 'ResetPasswordController@getPassword');
        Route::post('reset-password', 'ResetPasswordController@updatePassword');
    });
});

Route::group(['namespace' => 'Member'], function () {
    //Manager - Comment
    Route::group(['prefix' => 'member', 'middleware' => 'CheckMemberLogin'], function () {
        Route::get('comment', 'CommentController@index')->name('member.comment.index');

        Route::get('comment/edit/{id}', 'CommentController@edit');
        Route::put('comment/update/{id}', 'CommentController@update')->name('member.comment.update');

        Route::delete('comment/delete/{id}', 'CommentController@destroy')->name('member.comment.delete');
    });

    //Manager - Review
    Route::group(['prefix' => 'member', 'middleware' => 'CheckMemberLogin'], function () {
        Route::get('review', 'ReviewController@index')->name('member.review.index');

        Route::get('review/edit/{id}', 'ReviewController@edit');
        Route::put('review/update/{id}', 'ReviewController@update')->name('member.review.update');

        Route::delete('review/delete/{id}', 'ReviewController@destroy')->name('member.review.delete');
    });

    //Manager - Order
    Route::group(['prefix' => 'member', 'middleware' => 'CheckMemberLogin'], function () {
        Route::get('order', 'OrderController@index')->name('member.order.index');

        Route::get('order/show/{id}', 'OrderController@orderShow')->name('member.order.show');

        Route::delete('order/delete/{id}', 'OrderController@orderDelete')->name('member.order.destroy');

        Route::get('order/pdf/{id}','OrderController@exportPdf')->name('member.order.pdf');
    });


    // Order Track
    Route::middleware([CheckMemberLogin::class])->group(function () {
        Route::get('/product/track', 'OrderController@orderTrack')->name('order.track');
        Route::post('product/track/order', 'OrderController@productTrackOrder')->name('product.track.order');
    });
});

Route::group(['namespace' => 'Member'], function () {
    //Cart
    Route::group(['prefix' => 'cart', 'middleware' => 'CheckMemberLogin'], function () {
        Route::get('index', 'CartController@index')->name('cart.index');
        Route::get('form/create/{id}', 'CartController@store')->name('cart.store.form');
        
        //fiflter method
        Route::post('create/{id}', 'CartController@store')->name('cart.store');
        Route::get('create/{id}', 'CartController@store')->name('cart.store');

        Route::get('update', 'CartController@updateQuantity')->name('cart.update');
        Route::get('delete/{id}', 'CartController@remove')->name('cart.delete');
        Route::put('update/all', 'CartController@updateAll')->name('cart.update.all');
        Route::get('update/size', 'CartController@updateSize')->name('cart.update.size');


        //Check coupon
        Route::get('check-coupon', 'CartController@checkCoupon')->name('check.coupon');
    });

    Route::middleware([CheckMemberLogin::class])->group(function () {
        //Checkout
        Route::get('checkout', 'CheckoutController@getCheckout')->name('checkout');
        Route::post('checkout/order', 'CheckoutController@placeOrder')->name('checkout.place.order');

        //select province-district-ward
        Route::post('fetch-district', 'AjaxController@fetchDistrict');
        Route::post('fetch-ward', 'AjaxController@fetchWard');
    });

});

