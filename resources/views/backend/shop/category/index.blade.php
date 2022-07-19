@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6>
        @can('category-create')
        <a href="{{route('category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>name</th>
                        <th>Photo</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Stt</th>
                        <th>name</th>
                        <th>Photo</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($categories as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                            <img src="{{asset($value->photo)}}" class="img-fluid zoom" style="width:200px" alt="{{$value->photo}}">                       
                        </td>
                        <td>{{$value->parent['name']}}</td>                      
                        <td>
                            @if($value->status=='active')
                            <span class="badge badge-success">{{$value->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$value->status}}</span>
                            @endif
                        </td>
                        <td>
                            @can('category-edit')
                            <a href="{{route('category.edit',$value->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('category-delete')
                            <form method="POST" action="{{route('category.destroy',[$value->id])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm dltBtn" data-id='' style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right"></span>
            <h6 class="text-center">No Categories found!!! Please create Category</h6>
        </div>
    </div>
</div>
@endsection
