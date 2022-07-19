@extends('backend.layouts.master')
@section('title','E-SHOP || User Show')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'user.index', 'name' => 'User', 'key' => 'Show'])
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>name</th>
                        <th>Email</th>
                        <th colspan="2">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-center">
                            <a href="{{route('user.edit',$user->id)}}" title="Sửa {{$user->name}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                        <td title="Xóa {{$user->name}}">
                            <form action="{{route('user.destroy',$user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a></button>
                            </form>
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
