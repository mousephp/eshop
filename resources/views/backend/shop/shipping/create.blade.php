@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'shipping.index', 'name' => 'Shipping', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Shipping</h5>
    <div class="card-body">
      <form method="post" action="{{route('shipping.store')}}">
        @csrf 
        @method('POST')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="type" placeholder="Enter title"  value="{{old('type')}}" class="form-control">
        @error('type')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
        <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
        @error('price')
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
