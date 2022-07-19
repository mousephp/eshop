<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatePostRequest;
use App\Models\PostCate;
use App\Repositories\Contracts\CatePostRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class CategoryPostController extends Controller
{
    protected $catePost;

    public function __construct(CatePostRepositoryInterface $catePost)
    {
        $this->catePost = $catePost;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catePosts = $this->catePost->all();
        
        return view('backend.blog.category.index', compact('catePosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatePostRequest $request)
    {
        try {
            $cate_post_slug = Str::slug($request->name, '-');
            
            $catePost = $this->catePost->create([
                'name' => $request->name,
                'slug' => $cate_post_slug,
                'status' => $request->status,
            ]);

            return redirect()->back()->withInput($request->input())->with('message', 'Thêm thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):' . $exception->getMessage() . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function show(PostCate $categoryPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catePost = $this->catePost->find($id);

        return view('backend.blog.category.edit', compact('catePost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function update(CatePostRequest $request, $id)
    {
        try {
            $cate_post_slug = Str::slug($request->name, '-');

            $catePost = $this->catePost->update($id, [
                'name'   => $request->name,
                'slug'   => $cate_post_slug,
                'status' => $request->status,
            ]);

            return redirect()->route('cate-post.index')->with('message', 'Sửa thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):' . $exception->getMessage() . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->catePost->delete($id);

            return redirect()->route('cate-post.index')->with('message', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
