@extends('backend.layouts.master')
@section('title','E-SHOP || Member Index')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <a class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Member"><i class="fas fa-plus"></i> Add Member</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Photo</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>Confirm</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th colspan="5">Tùy chọn</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Photo</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>Confirm</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th colspan="5">Tùy chọn</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($members as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>
                            <img src="{{asset($value->image)}}" class="img-fluid zoom" style="width:200px" alt="{{$value->image}}">
                        </td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>
                            @if($value->confirmed == 1)
                            <span class="badge badge-info">True</span>
                            @else
                            <span class="badge badge-warning">False</span>
                            @endif
                        </td>
                        <td>
                            @if($value->status == 'active')
                            <span class="badge badge-success">{{$value->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$value->status}}</span>
                            @endif
                        </td>
                        <td>{{$value->created_at}}</td>

                        <td>
                            <form action="{{route('admin.member.open',$value->id)}}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-info btn-sm" data-id={{$value->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="open an account" ><i class="fas fa-arrow-alt-circle-left"></i></button>
                            </form>       
                        </td>
                        <td>
                            <form action="{{route('admin.member.lock',$value->id)}}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-danger btn-sm account_lock" data-id={{$value->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="account lock" ><i class="fas fa-user-lock"></i></button>
                            </form>       
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="show" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        </td>

                        <td title="Xóa {{$value->name}}">
                            <form action="{{route('admin.member.destroy',$value->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$value->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>                     
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
