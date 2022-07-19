<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CateRepositoryInterface;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;
use App\Components\Recusive;
use App\Models\Category;
use App\Traits\StorageImageTrait;
use DB;
use File;
use Log;
use Exception;

class CategoryController extends Controller
{
    use StorageImageTrait;

    protected $category;

    public function __construct(CateRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('backend.shop.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');

        return view('backend.shop.category.create',compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->title, '-');     

            $cate = [
                'name'      => $request->name,
                'slug'      => $slug,
                'summary'   => $request->summary,
                'status'    => $request->status,
                'parent_id' => $request->parent_id ? $request->parent_id : null,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'category');

            if (!empty($dataUploadFeatureImage)) {
                $cate['photo'] = $dataUploadFeatureImage['file_path'];
            }

            $this->category->create($cate);

            DB::commit();

            return redirect()->back()->withInput($request->input())->with('success','Thêm thành công');  
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        } 
    }

    public function getCategory($parentId)
    {
        $data       = $this->category->all();

        $recusive   = new Recusive($data);

        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate       = $this->category->find($id);

        $htmlOption = $this->getCategory($cate->parent_id);

        return view('backend.shop.category.edit', compact('cate', 'htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->name, '-');

            $cate = $this->category->update($id,[
                'name'      => $request->name,
                'slug'      => $slug,
                'summary'   => $request->summary,
                'status'    => $request->status,
                'parent_id' => $request->parent_id ? $request->parent_id : null,
            ]);

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'category');

            if (!empty($dataUploadFeatureImage)) {
                $imagePath = public_path($this->category->find($id)->photo);
                if(!empty(File::exists($imagePath))){
                    // unlink($imagePath);
                }
                $cateImg['photo'] = $dataUploadFeatureImage['file_path'];
            }

            if (isset($cateImg['photo'])) {
               $this->category->find($id)->update($cateImg);
            }
            
            DB::commit();

            return redirect()->route('category.index')->with('success','Sửa thành công'); 
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage() .$exception->getLine());
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->category->delete($id);

            return redirect()->route('category.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
