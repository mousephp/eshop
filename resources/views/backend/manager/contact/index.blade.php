@extends('backend.layouts.master')
@section('title','E-SHOP || Brand Page')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Contact List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($contacts) > 0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>name</th>
                        <th>subject</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>message</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>name</th>
                        <th>subject</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>message</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->id}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->subject}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->message}}</td>
                        <td>
                            @if($contact->status=='new')
                            <span class="badge badge-primary">{{$contact->status}}</span>
                            @elseif($contact->status=='process')
                            <span class="badge badge-warning">{{$contact->status}}</span>
                            @elseif($contact->status=='delivered')
                            <span class="badge badge-success">{{$contact->status}}</span>
                            @else
                            <span class="badge badge-danger">{{$contact->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('contact.admin.feeback',$contact->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="feeback" data-placement="bottom"><i class="fas fa-comment-dots"></i></a>
                            <form method="POST" action="{{route('contact.admin.destroy',[$contact->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$contact->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <span style="float:right">{{$contacts->links()}}</span> --}}
            @else
            <h6 class="text-center">No contacts found!!! Please create contact</h6>
            @endif
        </div>
    </div>
</div>
@endsection
