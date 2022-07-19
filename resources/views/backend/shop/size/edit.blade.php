@extends('backend.layouts.master')
@section('title','E-SHOP || Size Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'size.index', 'name' => 'Size', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Add Size</h5>
    <div class="card-body">
        <form method="post" action="{{route('size.update',$size->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" value="{{$size->name}}" placeholder="Enter name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" @if($size->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if($size->status == 'inactive') selected @endif>Inactive</option>
                    @if ($errors->has('status'))
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                    @endif
                </select>
                @if ($errors->has('status'))
                <p class="text-danger">{{ $errors->first('status') }}</p>
                @endif
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
