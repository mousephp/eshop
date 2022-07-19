@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'product-reject.index', 'name' => 'Product Reject', 'key' => 'Edit'])
<div class="card">
    <h5 class="card-header">Add Product-Reject</h5>
    <div class="card-body">
        <form method="post" action="{{route('product-reject.update',$reject->id)}}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price" value="{{$reject->price}}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="total">Total <span class="text-danger">*</span></label>
                <input id="Total" type="number" name="total" min="0" placeholder="Enter Total" value="{{$reject->total}}" class="form-control @error('total') is-invalid @enderror">
                @error('total')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="Note" class="col-form-label">Note <span class="text-danger">*</span></label>
                <textarea class="form-control" id="note" name="note">{!!$reject->note!!}</textarea>
                @error('note')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nhập products ids của sản phẩm</label>
                <input type="number" name="prod_id" min="0" placeholder="Enter Product (Id)" value="{{$reject->prod_id}}" class="form-control @error('prod_id') is-invalid @enderror" style="width:200px;">
                @error('prod_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" {{(($reject->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($reject->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
