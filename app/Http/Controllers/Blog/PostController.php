<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\{CatePostRepositoryInterface, TagsPostRepositoryInterface, UserRepositoryInterface,  PostRepositoryInterface };
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Models\{ PostCate, Post, PostTag};
use App\User;
use Auth;
use DB;
use Log;
use Exception;
use Storage;
use File;
use App\Traits\StorageImageTrait;

class PostController extends Controller
{
    use StorageImageTrait;

    protected $cate;
    protected $tag;
    protected $user;
    protected $post;

    public function __construct(
        CatePostRepositoryInterface $cate, TagsPostRepositoryInterface $tag, 
        UserRepositoryInterface $user, PostRepositoryInterface $post)
    {
        $this->user  = $user;
        $this->cate  = $cate;
        $this->tag   = $tag;
        $this->post  = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->cate->all();
        $tags       = $this->tag->all();
        $users      = $this->user->all();
        $posts      = $this->post->all();
        
        return view('backend.blog.post.index',compact('categories','tags','users','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->cate->all();
        $tags       = $this->tag->all();
        $users      = $this->user->all();

        return view('backend.blog.post.create',compact('categories', 'tags', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();    

            $slug = Str::slug($request->title, '-');
            
            $dataPostCreate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'summary'     => $request->summary,
                'description' => $request->description,
                'quote'       => $request->quote,
                'post_cate_id'=> $request->post_cate_id,
                'user_id'     => $request->user_id,
                'status'      => $request->status,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'post');

            if (!empty($dataUploadFeatureImage)) {
                $dataPostCreate['photo_name'] = $dataUploadFeatureImage['file_name'];
                $dataPostCreate['photo']      = $dataUploadFeatureImage['file_path'];
            }

            $post = $this->post->create($dataPostCreate);

            $post->tags()->attach($request->tags);
            
            DB::commit();

            return redirect()->back()->withInput($request->input())->with('message', 'Thêm thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->cate->all();
        $tags       = $this->tag->all();
        $users      = $this->user->all();
        $post       = $this->post->find($id);

        $listTagOfPost = PostTag::where('post_id', $id)->pluck('tag_id');

        return view('backend.blog.post.edit',compact('listTagOfPost', 'categories', 'tags', 'users', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try {
            DB::beginTransaction();     

            $slug = Str::slug($request->title, '-');

            $dataPostUpdate = [
                'title'       => $request->title,
                'slug'        => $slug,
                'summary'     => $request->summary,
                'description' => $request->description,
                'quote'       => $request->quote,
                'post_cate_id'=> $request->post_cate_id,
                'user_id'     => $request->user_id,
                'status'      => $request->status,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'photo', 'post');

            if (!empty($dataUploadFeatureImage)) {
                //remove image
                $imagePath = public_path($this->post->find($id)->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                $dataPostUpdate['photo_name'] = $dataUploadFeatureImage['file_name'];
                $dataPostUpdate['photo']      = $dataUploadFeatureImage['file_path'];
            }

            $this->post->find($id)->update($dataPostUpdate);

            $post = $this->post->find($id);

            $post->tags()->sync($request->tags);
            
            DB::commit();

            return redirect()->route('post.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $this->post->delete($id);

            return redirect()->back()->with('message', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
