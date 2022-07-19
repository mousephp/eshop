@extends('backend.layouts.master')
@section('title','E-SHOP || Tag Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'tags.index', 'name' => 'Tags', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Tag</h5>
    <div class="card-body">
      <form method="post" action="{{route('tags.store')}}">
       @csrf
       @method('POST')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter name"  value="{{old('name')}}" class="form-control">      
          @if ($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name') }}</p>
          @endif
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
         
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>
@endsection
