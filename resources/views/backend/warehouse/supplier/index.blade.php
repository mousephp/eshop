@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Suppliers List</h6>
      <a href="{{route('supplier.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Supplier</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($suppliers) > 0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>name</th>
              <th>phone</th>
              <th>email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>name</th>
              <th>phone</th>
              <th>email</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($suppliers as $supplier)   
                <tr>
                    <td>{{$supplier->id}}</td>
                    <td>{{$supplier->name}}</td>
                    <td>{{$supplier->phone}}</td>
                    <td>{{$supplier->email}}</td>
                    <td>
                        @if($supplier->status == 'active')
                            <span class="badge badge-success">{{$supplier->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$supplier->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('supplier.destroy',[$supplier->id])}}">
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$supplier->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete id={{$supplier->id}}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>                 
                </tr>  
            @endforeach
          </tbody>
        </table>
        {{-- <span style="float:right">{{$banners->links()}}</span> --}}
        @else
          <h6 class="text-center">No banners found!!! Please create supplier</h6>
        @endif
      </div>
    </div>
</div>
@endsection

