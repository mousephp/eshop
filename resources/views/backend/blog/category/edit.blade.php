@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'cate-post.index', 'name' => 'Category', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Edit Post Category</h5>
    <div class="card-body">
        <form method="post" action="{{route('cate-post.update',$catePost->id)}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title</label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{$catePost->name}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="active" {{(($catePost->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($catePost->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
