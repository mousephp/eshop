@extends('backend.layouts.master')
@section('title','E-SHOP || Setting Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'setting.index', 'name' => 'Setting', 'key' => 'Create'])
<div class="card">
    <h5 class="card-header">Add Setting</h5>
    <div class="card-body">
      <form action="{{ route('setting.store') . '?type='.request()->type }}" method="post">
          @csrf
          @method('POST')
          <div class="form-group">
              <label>Config key</label>
              <input type="text"
                      class="form-control @error('config_key') is-invalid @enderror"
                      name="config_key"
                      placeholder="Nhập config key"
              >
              @error('config_key')
              <div class="text-danger">{{ $message }}</div>
              @enderror
          </div>

          @if(request()->type === 'Text')
              <div class="form-group">
                  <label>Config value</label>
                  <input type="text"
                          class="form-control @error('config_value') is-invalid @enderror"
                          name="config_value"
                          placeholder="Nhập config value"
                  >
                  @error('config_value')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
              @elseif(request()->type === 'Textarea')
              <div class="form-group">
                  <label>Config value</label>
                  <textarea class="form-control @error('config_value') is-invalid @enderror"
                          name="config_value"
                          placeholder="Nhập config value"
                          rows="5"
                  ></textarea>
                  @error('config_value')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
{{-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> --}}
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    {{-- $('#lfm').filemanager('image'); --}}

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush