@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'tag-post.index', 'name' => 'Tag', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Edit Post Tag</h5>
    <div class="card-body">
        <form method="post" action="{{route('tag-post.update',$tagPost->id)}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Name</label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{$tagPost->name}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="active" {{(($tagPost->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($tagPost->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
