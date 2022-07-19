@extends('backend.layouts.master')

@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Product-Detail</h5>
    <div class="card-body">
        <form method="post" action="{{route('product-detail.update',$product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="amount">Amount <span class="text-danger">*</span></label>
                <input id="Amount" type="number" name="amount" min="0" placeholder="Enter Amount" value="{{old('amount')}}" class="form-control @error('amount') is-invalid @enderror">
                @error('amount')
                <span class=" text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="size">Size</label>
                <select name="sizes[]" class="form-control selectpicker" multiple="multiple" data-live-search="true">
                    <option value="">--Select any size--</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">Extra Large (XL)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <select name="colors[]" class="form-control selectpicker" multiple="multiple" data-live-search="true">
                    <option value="">--Select any color--</option>
                    <option value="Green">Green</option>
                    <option value="Blue">Blue</option>
                    <option value="Red">Red</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

