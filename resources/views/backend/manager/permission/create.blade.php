@extends('backend.layouts.master')
@section('title','E-SHOP || Permission Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'permission.index', 'name' => 'Permission', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Permission</h5>
    <div class="card-body">
        <form method="post" action="{{route('permission.store')}}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Tên quyền<span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Tên hiển thị<span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="display_name" placeholder="Enter display name" value="{{old('display_name')}}" class="form-control">
                @if ($errors->has('display_name'))
                <p class="text-danger">{{ $errors->first('display_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Chọn danh mục cha</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Chọn danh mục cha</option>
                    {!! $htmlOption !!}
                </select>
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Key code<span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="key_code" placeholder="Enter key code" value="{{old('key_code')}}" class="form-control">
                @if ($errors->has('key_code'))
                <p class="text-danger">{{ $errors->first('key_code') }}</p>
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
