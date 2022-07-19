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
      <h6 class="m-0 font-weight-bold text-primary float-left">Permissions Lists</h6>
      <a href="{{route('permission.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Role</a>
      <a href="{{route('permission.create-template')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-minus"></i>  Add Template Permission</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Stt</th>
              <th>name</th>
              <th>Display Name</th>
              <th>Key code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Stt</th>
              <th>name</th>
              <th>Display Name</th>
              <th>Key code</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
              @foreach($permissions as $key => $value)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->display_name}}</td>
                    <td>{{$value->key_code}}</td>
                    <td>
                    <a href="{{route('permission.edit',$value->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('permission.destroy',[$value->id])}}">
                      @csrf 
                      @method('delete')
                      <button type="submit" class="btn btn-danger btn-sm dltBtn" data-id='' style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    </td>
                </tr>  
              @endforeach
          </tbody>
        </table>
        <span style="float:right"></span>      
          <h6 class="text-center">No Categories found!!! Please create Permission</h6>      
      </div>
    </div>
</div>
@endsection
