@extends('backend.layouts.master')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'setting.index', 'name' => 'Setting', 'key' => 'Setting'])
<div class="card">
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
        <form method="post" action="{{route('settings.update')}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="short_des" class="col-form-label">Short Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('short_des') is-invalid @enderror" id="quote" name="short_des">{{$setting['short_des']}}</textarea>
                @error('short_des')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description_filemanager" name="description">{{$setting['description']}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{$setting['logo']}}">{{-- {{old('logo')}} --}}
                </div>
                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

                {{-- <div class="col-md-4 feature_image_container">
                    <div class="row">
                        <img class="feature_image" src="{{old('logo') ?: (!empty($setting)) ? $setting['logo'] : ''  }}" alt="" style='width:200px;'>
                    </div>
                </div> --}}

                @error('logo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$setting['photo']}}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" $setting value="{{$setting['address']}}">
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" $setting value="{{$setting['email']}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" $setting value="{{$setting['phone']}}">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

<script>
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
</script>


<!-- summernote config -->
<script>
  $(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });

        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#description_filemanager').summernote({
      toolbar: [
        ['popovers', ['lfm']],
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ],
      buttons: {
        lfm: LFMButton
      }
    })
  });
</script>
@endpush


{{-- tk: https://www.youtube.com/watch?v=iQZNabepPkQ&t=1406s --}}