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
      <h6 class="m-0 font-weight-bold text-primary float-left">Product Detail Lists</h6>
      <a href="{{route('product-detail.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($details)>0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>         
              <th>Price</th>
              <th>Size</th>
              <th>Product</th>
              <th>Color</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Price</th>
              <th>Size</th>
              <th>Product</th>
              <th>Color</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($details as $value)   
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->price}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->size}}</td>
                    <td>{{$value->color}}</td>
                    <td>{{$value->product->title}}</td>
                    <td>
                      <a href="{{route('value.edit',$value->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('value.destroy',[$value->id])}}">
                        @csrf 
                        @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$value->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        {{-- <span style="float:right">{{$details->links()}}</span> --}}
        @else
          <h6 class="text-center">No Products found!!! Please create Product</h6>
        @endif
      </div>
    </div>
</div>
@endsection
