<?php
use App\Http\Middleware\CheckLogedIn;
use App\Http\Middleware\CheckLogedOut;

Route::namespace ('Auth')->group(function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('login', 'LoginController@getLogin')->name('login');
        Route::post('login', 'LoginController@postLogin')->name('login');
    });

    //register - user
    Route::get('admin-register', 'RegisterController@getRegister')->name('admin.register');
    Route::post('admin-register', 'RegisterController@postRegister')->name('admin.register');

   
    //forgot-password
    Route::get('forgot-password', 'ForgotPasswordController@getEmail')->name('forgot-password');
    Route::post('forgot-password', 'ForgotPasswordController@postEmail')->name('forgot-password');
    Route::get('reset-password/{token}', 'ResetPasswordController@getPassword');
    Route::post('reset-password', 'ResetPasswordController@updatePassword');

    Route::middleware([CheckLogedOut::class])->group(function () {
    });

});

//admin-shop
Route::group(['namespace' => 'Admin'], function () {
    Route::get('logout', 'HomeController@logout')->name('logout');

    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        Route::get('/', 'HomeController@index')->name('admin');

        //chart js
        // Route::get('chartjs', 'HomeController@chartUser'])->name('chartjs.index');

        Route::get('profile', 'HomeController@profile')->name('profile');
        Route::post('/profile/{id}', 'HomeController@profileUpdate')->name('profile-update');

        //update password follow id
        Route::get('update-password', 'UserController@getUpdatePasswordId')->name('updatePasswordId');
        Route::post('update-password', 'UserController@postUpdatePasswordId')->name('updatePasswordId');

        Route::resource('role', 'RoleController');
        Route::resource('user', 'UserController');

        Route::get('member/index', 'memberController@index')->name('admin.member.index');
        Route::delete('member/{id}/destroy', 'memberController@destroy')->name('admin.member.destroy');
        Route::put('member/{id}/lock', 'memberController@accountLockMember')->name('admin.member.lock');
        Route::put('member/{id}/open', 'memberController@openAnAccountMember')->name('admin.member.open');


        Route::get('create-template', 'PermissionController@createTemplate')->name('permission.create-template');
        Route::post('create-template', 'PermissionController@createTemplateDataPermission')->name('permission.create-template-store');
        Route::resource('permission', 'PermissionController');

        Route::resource('brand', 'BrandController');

        Route::resource('color', 'ColorController');

        Route::resource('size', 'SizeController');

        Route::resource('product-detail', 'ProductDetailController');

        Route::resource('product-reject', 'ProductRejectController');

        Route::resource('tags', 'TagController');

        Route::resource('product', 'ProductController');

        Route::resource('product-review', 'ProductReviewController');

        Route::get('settings/setting', 'SettingController@editForm')->name('settings.update');
        Route::put('settings/setting', 'SettingController@updateSetting')->name('settings.update');
        Route::resource('setting', 'SettingController');

        Route::resource('banner', 'BannerController');

        Route::resource('coupon', 'CouponController');

        Route::resource('shipping', 'ShippingController');

        // Route::resource('category', 'CategoryController');
        Route::prefix('category')->group(function () {
            Route::get('/', [
                'as' => 'category.index',
                'uses' => 'CategoryController@index',
                'middleware' => 'can:category-list',
            ]);
            Route::get('create', [
                'as' => 'category.create',
                'uses' => 'CategoryController@create',
                'middleware' => 'can:category-create',
            ]);
            Route::post('store', [
                'as' => 'category.store',
                'uses' => 'CategoryController@store',
            ]);

            Route::get('edit/{id}', [
                'as' => 'category.edit',
                'uses' => 'CategoryController@edit',
                'middleware' => 'can:category-edit',
            ]);
            Route::put('update/{id}', [
                'as' => 'category.update',
                'uses' => 'CategoryController@update',
            ]);

            Route::delete('destroy/{id}', [
                'as' => 'category.destroy',
                'uses' => 'CategoryController@destroy',
                'middleware' => 'can:category-delete',
            ]);
        });

    });

});


//admin-posts
Route::group(['namespace' => 'Blog', 'middleware' => 'CheckLogedOut'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('cate-post', 'CategoryPostController');

        Route::resource('tag-post', 'TagPostController');

        Route::resource('post', 'PostController');

        Route::resource('comment', 'CommentController');
    });
});


//admin-posts
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        Route::get('order/index', 'OrderController@index')->name('admin.order.index');
        Route::get('order/show/{id}', 'OrderController@show')->name('admin.order.show');
        Route::delete('order/delete/{id}', 'OrderController@destroy')->name('admin.order.destroy');

    });
});




//Warehouse
Route::group(['namespace' => 'Warehouse'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('warehouse/index', 'WarehouseController@index')->name('admin.warehouse.index');

        Route::resource('supplier', 'SupplierController')->except(['show']);

    });
});


