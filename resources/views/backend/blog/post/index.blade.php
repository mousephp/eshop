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
        <h6 class="m-0 font-weight-bold text-primary float-left">Post Lists</h6>
        <a href="{{route('post.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Post</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($posts)>0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        {{-- <th>Tag</th> --}}
                        <th>Author</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        {{-- <th>Tag</th> --}}
                        <th>Author</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category['name']}}</td>
                        {{-- <td>
                      @foreach($posts->tags as $post)   
                      @endforeach
                  </td> --}}
                        <td>{{$post->admin['name']}}</td>
                        <td>
                            <img src="{{asset($post->photo)}}" class="img-fluid zoom" style="max-width:200px" alt="{{$post->photo}}">
                        </td>
                        <td>
                            @if($post->status == 'active')
                            <span class="badge badge-success">{{$post->status}}</span>
                            @else
                            <span class="badge badge-warning">{{$post->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('post.destroy',[$post->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$post->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <span style="float:right">{{$posts->links()}}</span> --}}
            @else
            <h6 class="text-center">No posts found!!! Please create Post</h6>
            @endif
        </div>
    </div>
</div>
@endsection
