@extends('backend.layouts.master')

@section('main-content')
{{-- <style>
    .card-header {
        background-color: #00e765;
    }

    input[type="checkbox"] {
        transform: scale(1.2);
    }
</style> --}}
@include('backend.partials.content-header', ['router' => 'permission.index', 'name' => 'Permission', 'key' => 'Create'])

<div class="card">
    <h5 class="card-header">Add Permission</h5>
    <div class="card-body">
        <form class="form-horizontal" action="{{route('permission.create-template-store')}}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label>Chon tên module</label>
                <select class="form-control" name="module_parent">
                    <option value="">Chon tên module</option>
                    @foreach($configTableModule as $key => $moduleItem)
                    <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="row">
                    @foreach($configModuleChildrent as $moduleItemChilrent)
                    <div class="col-md-2">
                        <label for="">
                            <input type="checkbox" value="{{ $moduleItemChilrent }}" name="module_chilrent[]">
                            {{ $moduleItemChilrent }}
                        </label>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection


<script>
    $('#is_parent').change(function() {
        var is_checked = $('#is_parent').prop('checked');
        // alert(is_checked);
        if (is_checked) {
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        } else {
            $('#parent_cat_div').removeClass('d-none');
        }
    })

</script>
{{-- @endpush --}}
