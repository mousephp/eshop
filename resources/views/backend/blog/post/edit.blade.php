@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'post.index', 'name' => 'Post', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Add Post</h5>
    <div class="card-body">
        <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$post->title}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="quote" class="col-form-label">Quote</label>
                <textarea class="form-control" id="quote" name="quote">{{$post->quote}}</textarea>
                @error('quote')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="summary" name="summary">{{$post->summary}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{$post->description}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Chọn danh mục</label>
                <select class="form-control select2_init @error('post_cate_id') is-invalid @enderror" name="post_cate_id">
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $key => $data)
                    <option value='{{$data->id}}' @if($post->post_cate_id == $data->id) selected @endif>{{$data->name}}</option>
                    @endforeach
                </select>
                @error('post_cate_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>tags</label>
                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                    <option value="">--Select Tags--</option>
                    @foreach($tags as $value)
                    <option value="{{$value->id}}" {{$listTagOfPost->contains($value->id) ? 'selected' :''}}>
                        {{$value->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="added_by">Author</label>
                <select name="user_id" class="form-control">
                    <option value="">--Select any one--</option>
                    @foreach($users as $value)
                    <option value="{{$value->id}}" @if($value->id == $post->user_id) selected @endif>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input type="file" id="thumbnail" class="form-control" type="text" name="photo">
                </div>
                <div class="col-md-4 feature_image_container">
                    <div class="row">
                        <img class="feature_image" src="{{asset($post->photo)}}" alt="" style='width:200px;'>
                    </div>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" {{(($post->status=='active')? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($post->status=='inactive')? 'selected' : '')}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
