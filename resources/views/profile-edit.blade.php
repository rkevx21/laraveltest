@extends('layouts.app')
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
{{--   <script src="js/jquery_c.js"></script>
  <script src="js/croppie.js"></script>
  <link href="css/croppie.css" rel="stylesheet"> --}}
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body"> 

                    <form method="POST" action="{{ route('profile.update', [$profileEdit->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

{{--                         <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                            <div class="avatar"> <img class="rounded-circle" width="150" height="150" src="/storage/profile_images/{{ $profileEdit->avatar}}" /></div><br>
                            <div id="upload-demo" class="croppie" style="display:none"></div>  
                            <input type="file" id="image_file" name="avatar">
                            <button class="btn btn-primary upload-image" id="upload" type="button"style="margin-top:2%">Upload</button>
                            <button class="btn btn-danger cancel-image" type="button" style="margin-top:2%; display:none">Cancel</button>
                            <div class="alert alert-success" id="upload-success" style="display: none;margin-top:10px;"></div>
                            <div class="col-md-4">
                            <div id="preview-crop-data"></div>
                            </div>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $profileEdit->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $profileEdit->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}
                            </label>

                            <div class="col-md-6">

                                <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required autofocus>

                                    @foreach($gender as $gender)
                                        <div>
                                            @if($gender == $profileEdit->gender)
                                                <option value='{{ $gender }}' selected='selected'>{{ $gender }}</option>
                                            @else
                                                <option value='{{ $gender }}'>{{ $gender }}</option>
                                            @endif   
                                        </div>
                                    @endforeach            
                                                       
                                </select> 
                                                  
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}
                            </label>

                            <div class="col-md-6">

                                <select id="education" class="form-control{{ $errors->has('education') ? ' is-invalid' : '' }}" name="education" required autofocus>

                                    @foreach($education as $education)
                                        <div>
                                            @if($education == $profileEdit->education)
                                                <option value='{{ $education }}' selected='selected'>{{ $education }}</option>
                                            @else
                                                <option value='{{ $education }}'>{{ $education }}</option>
                                            @endif   
                                        </div>
                                    @endforeach            
                                                       
                                </select> 
                                                  
                                @if ($errors->has('education'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('education') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $profileEdit->address }}" required>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}
                            </label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus> {{ $profileEdit->description }}
                                </textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="save">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var resize = $('#upload-demo').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 150,
        height: 150,
        type: 'circle' //square
    },
    boundary: {
        width: 200,
        height: 200
    }
});
$('#image_file').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    console.log('TEST');
    $("div.croppie").show();
    $("div.avatar").hide();
    $(".cancel-image").show();
});
$('.upload-image').on('click', function (ev) {
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    html_data = '<input name="img_val" type="hidden" value="' + img + '">';
    $("#preview-crop-data").html(html_data);
    $("#upload-success").html("Uploaded successfully.");
    $("#upload-success").show();
  });
});

$('.cancel-image').on('click', function (ev) {
    $("div.croppie").hide();
    $("div.avatar").show();
    $(".cancel-image").hide();
});
</script>

@endsection
