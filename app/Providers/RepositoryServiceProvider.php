<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Manager
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\Eloquents\RoleRepository;
use App\Repositories\Contracts\RoleRepositoryInterface;

use App\Repositories\Eloquents\PermissionRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;


//Shop
use App\Repositories\Eloquents\CateRepository;
use App\Repositories\Contracts\CateRepositoryInterface;

use App\Repositories\Eloquents\SettingRepository;
use App\Repositories\Contracts\SettingRepositoryInterface;

use App\Repositories\Eloquents\TagsRepository;
use App\Repositories\Contracts\TagsRepositoryInterface;

use App\Repositories\Eloquents\BrandRepository;
use App\Repositories\Contracts\BrandRepositoryInterface;

use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

use App\Repositories\Eloquents\ProductReviewRepository;
use App\Repositories\Contracts\ProductReviewRepositoryInterface;

use App\Repositories\Eloquents\ProductImageRepository;
use App\Repositories\Contracts\ProductImageRepositoryInterface;

use App\Repositories\Eloquents\BannerRepository;
use App\Repositories\Contracts\BannerRepositoryInterface;

use App\Repositories\Eloquents\CouponRepository;
use App\Repositories\Contracts\CouponRepositoryInterface;

use App\Repositories\Eloquents\ShippingRepository;
use App\Repositories\Contracts\ShippingRepositoryInterface;

use App\Repositories\Eloquents\ProductRejectRepository;
use App\Repositories\Contracts\ProductRejectRepositoryInterface;

use App\Repositories\Eloquents\ColorRepository;
use App\Repositories\Contracts\ColorRepositoryInterface;

use App\Repositories\Eloquents\SizeRepository;
use App\Repositories\Contracts\SizeRepositoryInterface;

use App\Repositories\Eloquents\ProductDetailRepository;
use App\Repositories\Contracts\ProductDetailRepositoryInterface;


//Post
use App\Repositories\Eloquents\TagsPostRepository;
use App\Repositories\Contracts\TagsPostRepositoryInterface;

use App\Repositories\Eloquents\CatePostRepository;
use App\Repositories\Contracts\CatePostRepositoryInterface;

use App\Repositories\Eloquents\PostRepository;
use App\Repositories\Contracts\PostRepositoryInterface;

//client
use App\Repositories\Eloquents\FrontendRepository;
use App\Repositories\Contracts\FrontendRepositoryInterface;

use App\Repositories\Eloquents\WishlistRepository;
use App\Repositories\Contracts\WishlistRepositoryInterface;

use App\Repositories\Eloquents\CommentRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;

use App\Models\Brand;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);   
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);   
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);   

        $this->app->bind(CateRepositoryInterface::class,CateRepository::class);   
        $this->app->bind(SettingRepositoryInterface::class,SettingRepository::class);   
        $this->app->bind(TagsRepositoryInterface::class,TagsRepository::class);   
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);   
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);   
        $this->app->bind(ProductReviewRepositoryInterface::class,ProductReviewRepository::class); 
        $this->app->bind(ProductImageRepositoryInterface::class,ProductImageRepository::class);   
        $this->app->bind(BannerRepositoryInterface::class,BannerRepository::class);   
        $this->app->bind(CouponRepositoryInterface::class,CouponRepository::class);   
        $this->app->bind(ShippingRepositoryInterface::class,ShippingRepository::class);   

        $this->app->bind(ProductDetailRepositoryInterface::class,ProductDetailRepository::class);   
        $this->app->bind(SizeRepositoryInterface::class,SizeRepository::class);   
        $this->app->bind(ColorRepositoryInterface::class,ColorRepository::class);   
        $this->app->bind(ProductRejectRepositoryInterface::class,ProductRejectRepository::class);   

        $this->app->bind(TagsPostRepositoryInterface::class,TagsPostRepository::class);   
        $this->app->bind(CatePostRepositoryInterface::class,CatePostRepository::class);   
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);   
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);   

        $this->app->bind(FrontendRepositoryInterface::class,FrontendRepository::class);   
        // $this->app->bind(WishlistRepositoryInterface::class,WishlistRepository::class);   
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $data['brands'] = Brand::all();

        view()->share($data);
    }
}
