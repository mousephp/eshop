@extends('backend.layouts.master')
@section('title','E-SHOP || Supplier Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'supplier.index', 'name' => 'Supplier', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Supplier</h5>
    <div class="card-body">
        <form method="post" action="{{route('supplier.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Phone <span class="text-danger">*</span></label>
                <input id="inputTitle" type="number" name="phone" placeholder="Enter phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input id="inputTitle" type="email" name="email" placeholder="Enter email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputDesc" class="col-form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{old('address')}}</textarea>
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Shop Name <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="shop_name" placeholder="Enter Shop Name" value="{{old('shop_name')}}" class="form-control @error('shop_name') is-invalid @enderror">
                @error('shop_name')
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
