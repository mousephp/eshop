<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\{ UserRepositoryInterface, CateRepositoryInterface, BrandRepositoryInterface };
use App\Repositories\Contracts\{ TagsRepositoryInterface, ProductImageRepositoryInterface, ProductRepositoryInterface };
use App\Repositories\Contracts\{ SizeRepositoryInterface, ColorRepositoryInterface };
use App\Models\{ Product, ProductTag, Brand, Tag, Size, Color, Category, ProductImage };
use App\Http\Requests\ProductRequest;
use App\Components\Recusive;
use App\Traits\StorageImageTrait;
use App\User;
use Log;
use Exception;
use Auth;
use Storage;
use DB;
use Str;
use File;

class ProductController extends Controller
{
    use StorageImageTrait;

    protected $user;
    protected $cate;
    protected $brand;
    protected $tag;
    protected $productImage;
    protected $product;
    protected $size;
    protected $color;

    public function __construct(
        UserRepositoryInterface $user, CateRepositoryInterface $cate, 
        BrandRepositoryInterface $brand, TagsRepositoryInterface $tag, 
        ProductImage $productImage, ProductRepositoryInterface $product,
        SizeRepositoryInterface $size, ColorRepositoryInterface $color
    )
    {
        $this->user         = $user;
        $this->cate         = $cate;
        $this->brand        = $brand;
        $this->tag          = $tag;
        $this->product      = $product;
        $this->productImage = $productImage;
        $this->size         = $size;
        $this->color        = $color;
    }

    public function firstOrCreateColor($request, $product)
    {
        // Insert colors for product
        $colorIds = [];
        if (!empty($request->colors)) {
            foreach ($request->colors as $key => $colorItem) {
                $colorInstance = Color::firstOrCreate(['name' => $colorItem]);
                $colorIds[]    = $colorInstance->id;
            }
        }
        
        if ($colorIds) {
            $product->color()->sync($colorIds);
        }     
    }
   
   
    public function firstOrCreateSize($request, $product)
    {
        // Insert sizes for product
        $sizeIds = [];
        if (!empty($request->sizes)) {
            foreach ($request->sizes as $sizeItem) {
                $sizeInstance = Size::firstOrCreate(['name' => $sizeItem]);
                $sizeIds[]    = $sizeInstance->id;
            }
        }
    
        if ($sizeIds) {
            $product->size()->sync($sizeIds);
        }  
    }

    public function index()
    {
        $brands   = $this->brand->all();
        $products = $this->product->all();

        return view('backend.shop.product.index',compact('products','brands'));
    }

    public function create()
    {
        $users      = $this->user->all();
        $categories = $this->cate->all();
        $tags       = $this->tag->all();
        $brands     = $this->brand->all();

        $htmlOption = $this->getCategory($parentId = '');

        return view('backend.shop.product.create', compact('htmlOption', 'users', 'categories', 'tags', 'brands'));
    }

    public function getCategory($parentId)
    {
        $data       = $this->cate->all();

        $recusive   = new Recusive($data);

        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function createProduct($request, $dataProductCreate)
    {
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

        if (!empty($dataUploadFeatureImage)) {
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $product = $this->product->create($dataProductCreate);

        // Insert data to product_images
        if ($request->hasFile('image_path')) {
            foreach ($request->image_path as $fileItem) {
                $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

                $product->productImages()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name']
                ]);
            }
        }

        // Insert sizes for product
        $this->firstOrCreateColor($request, $product);          
    
        // Insert colors for product
        $this->firstOrCreateSize($request, $product);

        //attach tags
        $product->tags()->attach($request->tags);        
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();     
                 
            $slug = Str::slug($request->title,'-');

            $dataProductCreate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'price'       => $request->price,
                'discount'    => $request->discount,
                'quantity'    => $request->quantity,           
                'stock_in'    => $request->stock_in,           
                'stock_out'   => $request->stock_out,           
                'condition'   => $request->condition,
                'status'      => $request->status,
                'summary'     => $request->summary,
                'description' => $request->description,
                'is_featured' => $request->is_featured,
                'cate_id'     => $request->cate_id,
                'brand_id'    => $request->brand_id,
                'user_id'     => $request->user_id,
            ];

            //create image
            $this->createProduct($request, $dataProductCreate);
             
            DB::commit();

            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');       
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error(loi): ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $users      = $this->user->all();
        $categories = $this->cate->all();
        $tags       = $this->tag->all();
        $brands     = $this->brand->all();

        $product    = $this->product->find($id);
        
        $items      = Product::where('id',$id)->get();

        $htmlOption = $this->getCategory($product->cate_id);

        $listTagOfProduct   = DB::table('product_tags')->where('prod_id',$id)->pluck('tag_id');
        $listSizeOfProduct  = DB::table('product_sizes')->where('prod_id',$id)->pluck('size_id');
        $listColorOfProduct = DB::table('color_products')->where('prod_id',$id)->pluck('color_id');

        return view('backend.shop.product.edit', compact('items','listTagOfProduct','htmlOption', 'users', 'categories', 'tags', 'brands', 'product', 'listSizeOfProduct', 'listColorOfProduct'));
    }

    public function updateProductImages($id, $request)
    {
        $product = $this->product->find($id);

        if ($request->hasFile('image_path')) {       
            //remove image    
            $product = $this->product->find($id);

            $productImg = $this->productImage->all();

            foreach ($productImg as $key => $value) {
                if( $product->id == $value->prod_id){
                    $imagePathMultiple = public_path($value->image_path);

                    if(File::exists($imagePathMultiple)){
                        // unlink($imagePathMultiple);
                    }
                }
            }

            //update image-path/image-name
            $remove = $this->productImage->where('prod_id', $id)->delete();

            foreach ($request->image_path as $fileItem) {
                $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

                $product->productImages()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name']
                ]);
            }
        }
    }
    
    public function updateProduct($id, $request, $dataProductUpdate)
    {
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

        if (!empty($dataUploadFeatureImage)) {
            //remove image
            $imagePath = public_path($this->product->find($id)->feature_image_path);

            if(File::exists($imagePath)){
                // unlink($imagePath);
            }

            // update image-path/image-name
            $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $this->product->find($id)->update($dataProductUpdate);     

        // Insert data to product_images
        $this->updateProductImages($id, $request);

        // Insert sizes for product
        $this->firstOrCreateColor($request, $product);          
        
        // Insert colors for product
        $this->firstOrCreateSize($request, $product);

        // attach tags
        $product->tags()->sync($request->tags);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->title,'-');

            $dataProductUpdate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'price'       => $request->price,
                'discount'    => $request->discount,
                'quantity'    => $request->quantity,           
                'stock_in'    => $request->stock_in,           
                'stock_out'   => $request->stock_out,           
                'condition'   => $request->condition,
                'status'      => $request->status,
                'summary'     => $request->summary,
                'description' => $request->description,
                'is_featured' => $request->is_featured,
                'cate_id'     => $request->cate_id,
                'brand_id'    => $request->brand_id,
                'user_id'     => $request->user_id,
            ];

            //create image
            $this->updateProduct($id, $request, $dataProductUpdate); 
            
            DB::commit();

            return redirect()->route('product.index')->with('success','Sửa thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error(loi): ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $file    = $this->product->find($id)->prod_img;
        // $this->deleteFile('layouts/uploads/products',$file);

        try {
            $this->product->delete($id);

            return redirect()->back()->with('success','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

    public function search(Request $request)
    {
        // $products = $this->product->getProductSearch($request);
        // return view('user.product.index', compact('products'));
    }

}
