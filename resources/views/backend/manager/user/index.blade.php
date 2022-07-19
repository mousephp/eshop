@extends('backend.layouts.master')
@section('title','E-SHOP || User Index')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      <a href="{{route('user.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
          	<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
	            <thead>
					<tr>
						<th>STT</th>
						<th>name</th>
						<th>Email</th>
						<th colspan="3">Tùy chọn</th>
					</tr>
	            </thead>
	            <tfoot>
					<tr>
						<th>STT</th>
						<th>name</th>
						<th>Email</th>
						<th colspan="3">Tùy chọn</th>
					</tr>
	          	</tfoot>
				<tbody>
					@foreach($users as $key => $value)
					<tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
						<td class="text-center">
							 <a href="{{route('user.show',$value->id)}}" title="Sửa {{$value->name}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i> Hiển thị</a>  
							<td>
								<a href="{{route('user.edit',$value->id)}}" title="Sửa {{$value->name}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
							</td>                           
                            <td  title="Xóa {{$value->name}}" >
                                <form action="{{route('user.destroy',$value->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a></button>
                                </form>
                            </td>
                        </td>
					</tr>
					@endforeach
				</tbody>
     		</table>
	    </div>
	</div>	 
</div>
@endsection
