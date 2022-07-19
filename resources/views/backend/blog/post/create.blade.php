@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'post.index', 'name' => 'Post', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Post</h5>
    <div class="card-body">
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="quote" class="col-form-label">Quote</label>
                <textarea class="form-control" id="quote" name="quote">{{old('quote')}}</textarea>
                @error('quote')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="post_cate_id">Category <span class="text-danger">*</span></label>
                <select name="post_cate_id" class="form-control">
                    <option value="">--Select any category--</option>
                    @foreach($categories as $key => $data)
                    <option value='{{$data->id}}'>{{$data->name}}</option>
                    @endforeach
                </select>
                @error('post_cate_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>tags</label>
                <select name="tags[]" class="form-control selectpicker" multiple="multiple">
                    <option value="">--Select Tags--</option>
                    @foreach($tags as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                @error('tags')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="added_by">Author</label>
                <select name="user_id" class="form-control">
                    <option value="">--Select any one--</option>
                    @foreach($users as $key => $data)
                    <option value='{{$data->id}}'>{{$data->name}}</option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input type="file" id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
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