@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'product.index', 'name' => 'Product', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" class="form-control-file" name="feature_image_path">
                @error('feature_image_path')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Ảnh chi tiết</label>
                <input type="file" multiple class="form-control-file" name="image_path[]">
            </div>

            <div class="form-group">
                <label for="is_featured">Is Featured</label><br>
                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
            </div>

            <div class="form-group">
                <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

             <div class="form-group">
                <label for="condition">Condition</label>
                <select name="condition" class="form-control">
                    <option value="">--Select Condition--</option>
                    <option value="default">Default</option>
                    <option value="new">New</option>
                    <option value="hot">Hot</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="quantity" min="0" placeholder="Enter quantity" value="{{old('quantity')}}" class="form-control @error('quantity') is-invalid @enderror">
                @error('quantity')
                <span class=" text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock_in">Stock In <span class="text-danger">*</span></label>
                <input id="stock_in" type="number" name="stock_in" min="0" placeholder="Enter Stock In" value="{{old('stock_in')}}" class="form-control @error('stock_in') is-invalid @enderror">
                @error('stock_in')
                <span class=" text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock out">Stock Out <span class="text-danger">*</span></label>
                <input id="stock_out" type="number" name="stock_out" min="0" placeholder="Enter Stock Out" value="{{old('stock_out')}}" class="form-control @error('stock_out') is-invalid @enderror">
                @error('stock_out')
                <span class=" text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary">{{old('summary')}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"" id="description" name="description">{{old('description')}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="discount" class="col-form-label">Discount(%)</label>
                <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount" value="{{old('discount')}}" class="form-control">
                @error('discount')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

             <div class="form-group">
                <label>Nhập sizes cho sản phẩm</label>
                <select name="sizes[]" class="form-control sizes_select_choose" multiple="multiple">
                </select>
                @error('sizes')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nhập colors cho sản phẩm</label>
                <select name="colors[]" class="form-control colors_select_choose" multiple="multiple">
                </select>
                @error('colors')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Chọn danh mục</label>
                <select class="form-control selectpicker @error('cate_id') is-invalid @enderror" name="cate_id">
                    <option value="">Chọn danh mục</option>
                    {!! $htmlOption !!}
                </select>
                @error('cate_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" class="form-control">
                    <option value="">--Select Brand--</option>
                    @foreach($brands as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nhập tags cho sản phẩm</label>
                <select name="tags[]" class="form-control selectpicker" multiple="multiple">
                    <option value="">--Select Tags--</option>
                    @foreach($tags as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
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

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control">
                    <option value="">--Select User--</option>
                    @foreach($users as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                @error('user_id')
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



<style>
    .select2-selection__choice {
        background-color: #1b2d1f !important;
    }
</style>


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
</script>
@endpush
