@extends('backend.layouts.master')

@section('main-content')
<div class="card">
    <h5 class="card-header">Add Product-Detail</h5>
    <div class="card-body">
        <form method="post" action="{{route('product-detail.store')}}">
            @csrf
            @method('POST')

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
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group">
                <label>Nhập products ids của sản phẩm</label>
                <input type="number" name="product" min="0" placeholder="Enter Product" value="{{old('product')}}" class="form-control @error('product') is-invalid @enderror" style="width:50px;">
                @error('product')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nhập sizes cho sản phẩm</label>
                <select name="sizes[]" class="form-control sizes_select_choose" multiple="multiple">
                </select>
                @error('size')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nhập colors cho sản phẩm</label>
                <select name="colors[]" class="form-control colors_select_choose" multiple="multiple">
                </select>
                @error('color')
                <span class=" text-danger">{{$message}}</span>
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


@push('scripts')
<script src="{{ asset('backend/vendor/select2/select2.min.js') }}"></script>
<link href="{{ asset('backend/vendor/select2/select2.min.css') }}" rel="stylesheet" />

<script>
    $(".sizes_select_choose").select2({
        tags: true
        , tokenSeparators: [',']
    });

    $(".colors_select_choose").select2({
        tags: true
        , tokenSeparators: [',']
    });

    $(".select2_init").select2({
        placeholder: "Chọn danh mục",
        allowClear: true
    });

</script>
@endpush


<style>
    .select2-selection__choice {
        background-color: #1b2d1f !important;
    }
</style>
