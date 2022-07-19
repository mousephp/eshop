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
        <h6 class="m-0 font-weight-bold text-primary float-left">Post Tag Lists</h6>
        <a href="{{route('tag-post.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Post Tag</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($tagPosts)>0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($tagPosts as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->slug}}</td>
                        <td>
                            @if($data->status=='active')
                            <span class="badge badge-success">{{$data->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$data->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('tag-post.edit',$data->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('tag-post.destroy',[$data->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$data->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <span style="float:right">{{$tagPosts->links()}}</span> --}}
            @else
            <h6 class="text-center">No Post Tag found!!! Please create post tag</h6>
            @endif
        </div>
    </div>
</div>
@endsection
