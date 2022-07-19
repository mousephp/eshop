@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Edit')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'banner.index', 'name' => 'Banner', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
        <form method="post" action="{{route('banner.update',$banner->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$banner->title}}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputDesc" class="col-form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{$banner->description}}</textarea>
                @error('description')
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
                    <input type="file" id="thumbnail" class="form-control" name="photo">
                </div>
                <div class="col-md-4 feature_image_container">
                    <div class="row">
                        <img class="feature_image" src="{{asset($banner->photo)}}" alt="" style='width:200px;'>
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
                    <option value="active" {{(($banner->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($banner->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
