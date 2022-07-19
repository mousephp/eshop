@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'category.index', 'name' => 'Category', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Edit Category</h5>
    <div class="card-body">
        <form method="post" action="{{route('category.update',$cate->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter title" value="{{$cate->name}}" class="form-control @error('name') is-invalid @enderror">
                @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="summary" name="summary">{{$cate->summary}}</textarea>
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input type="file" id="thumbnail" class="form-control" name="photo">
                </div>
                <div class="col-md-4 feature_image_container">
                    <div class="row">
                        <img class="feature_image" src="{{asset($cate->photo)}}" alt="" style='width:200px;'>
                    </div>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Chọn danh mục cha</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Chọn danh mục cha</option>
                    {!! $htmlOption !!}
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" @if($cate->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if($cate->status == 'inactive') selected @endif>Inactive</option>
                </select>
                @if ($errors->has('status'))
                <p class="text-danger">{{ $errors->first('status') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection


