<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagPostRequest;
use App\Repositories\Contracts\TagsPostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TagPost;
use Exception;
use Log;

class TagPostController extends Controller
{
    protected $tagPost;

    public function __construct(TagsPostRepositoryInterface $tagPost)
    {
        $this->tagPost = $tagPost;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagPosts = $this->tagPost->all();

        return view('backend.blog.tag.index', compact('tagPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagPostRequest $request)
    {
        try {
            $tag_post_slug = Str::slug($request->name, '-');

            $tagPost = $this->tagPost->create([
                'name'   => $request->name,
                'slug'   => $tag_post_slug,
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
     * @param  \App\Models\TagsPost  $TagsPost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TagsPost  $TagsPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tagPost = $this->tagPost->find($id);

        return view('backend.blog.tag.edit', compact('tagPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagsPost  $TagsPost
     * @return \Illuminate\Http\Response
     */
    public function update(TagPostRequest $request, $id)
    {
        try {
            $tag_post_slug = Str::slug($request->name, '-');

            $tagPost = $this->tagPost->update($id, [
                'name'   => $request->name,
                'slug'   => $tag_post_slug,
                'status' => $request->status,
            ]);

            return redirect()->route('tag-post.index')->with('message', 'Sửa thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):' . $exception->getMessage() . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagsPost  $TagsPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $this->tagPost->delete($id);
        
            return redirect()->route('tag-post.index')->with('message', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }

}
