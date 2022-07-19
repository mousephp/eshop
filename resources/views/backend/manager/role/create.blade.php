@extends('backend.layouts.master')
@section('title','E-SHOP || Role Create')
@section('main-content')
<style>
    .card-header {
        background-color: #00e765;
    }

    input[type="checkbox"] {
        transform: scale(1.2);
    }
</style>
@include('backend.partials.content-header', ['router' => 'role.index', 'name' => 'Role', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Role</h5>
    <div class="card-body">
        <form method="post" action="{{route('role.store')}}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Tên vai trò<span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Tên hiển thị<span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="display_name" placeholder="Enter display name" value="{{old('display_name')}}" class="form-control @error('display_name') is-invalid @enderror">
                @if ($errors->has('display_name'))
                <p class="text-danger">{{ $errors->first('display_name') }}</p>
                @endif
            </div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <label><input type="checkbox" class="checkall">checkall</label>
        </div>
        @foreach($permissionsParent as $permissionsParentItem)
        <div class="cardx border-primary mb-3 col-md-12">
            <div class="card-header">
                <label>- <input type="checkbox" value="" class="checkbox_wrapper">-</label>
                Module {{ $permissionsParentItem->name }}
            </div>
            <div class="row">
                @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                <div class="card-body text-primary col-md-3">
                    <h5 class="card-title">
                        <label>
                            <input type="checkbox" name="permission[]" class="checkbox_childrent" value="{{ $permissionsChildrentItem->id }}">
                        </label>
                        {{ $permissionsChildrentItem->name }}
                    </h5>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group mb-3">
    <button type="reset" class="btn btn-warning">Reset</button>
    <button class="btn btn-success" type="submit">Submit</button>
</div>
</form>
</div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script>
    $('.checkbox_wrapper').on('click', function() {
        $(this).parents('.cardx').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkall').on('click', function() {
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));

    });
</script>
@endsection
