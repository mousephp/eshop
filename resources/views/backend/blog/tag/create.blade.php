@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'tag-post.index', 'name' => 'Tag', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Post Category</h5>
    <div class="card-body">
        <form method="post" action="{{route('tag-post.store')}}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title</label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter title" value="{{old('name')}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
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
