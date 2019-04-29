  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  {{-- <script src="js/croppie.jquery.js"></script> --}}
  {{-- <script src="{{ mix('js/jquery.js') }}" defer></script> --}}
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="panel panel-info">
    <div class="panel-heading">Laravel - Crop and upload an image with jQuery Croppie plugin using Ajax</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4 text-center">
        <div id="upload-demo"></div>  
        </div>
        <div class="col-md-4" style="padding:5%;">
        <strong>Choose image to crop:</strong>
        <input type="file" id="image_file">
        <button class="btn btn-primary btn-block upload-image" style="margin-top:2%">Upload Image</button>
        <div class="alert alert-success" id="upload-success" style="display: none;margin-top:10px;"></div>
        </div>
        <div class="col-md-4">
        <div id="preview-crop-image" style="background:#9d9d9d;width:200;padding:50px 50px;height:200;"></div>
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
        width: 100,
        height: 100,
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
        $original_image = e.target.result;
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});
$('.upload-image').on('click', function (ev) {
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    html = '<img src="' + img + '" />';
    $("#preview-crop-image").html(html);
    $("#upload-success").html("Images cropped and uploaded successfully.");
    $("#upload-success").show();
    $.ajax({
      url: "{{ route('uploadImage') }}",
      type: "POST",
      // data: {"image":img},
      data: {"image":img,"original_image":$original_image},
      success: function (data) {
        
      }
    });
  });
});
</script>