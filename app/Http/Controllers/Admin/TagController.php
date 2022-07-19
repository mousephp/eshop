<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TagsRepositoryInterface;
use Illuminate\Support\Str;
use App\Http\Requests\TagRequest;
use Log;
use Exception;
use App\Models\Tag;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagsRepositoryInterface $tag)
    {
        $this->tag = $tag;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->all();

        return view('backend.shop.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shop.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {
            $cate = $this->tag->create([
                'name'      => $request->name,
                'status'    => $request->status,
            ]);

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tag->find($id);

        return view('backend.shop.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        try {
            $cate = $this->tag->update($id,[
                'name'      => $request->name,
                'status'    => $request->status,
            ]);

            return redirect()->route('tags.index')->with('message','Sửa thành công');  
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().$exception->getLine());
        }     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        try {
            $this->tag->delete($id);
        
            return redirect()->route('tags.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
