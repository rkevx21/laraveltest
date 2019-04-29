<!DOCTYPE html>
<html>
<head>
  <title>TEST</title>
  <link rel="stylesheet" href="css/imgareaselect.css">
</head>
<body>

  <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
    @csrf
      Upload Image: <input type="file" name="image" id="image" />
      <input type="hidden" name="x1" value="" />
      <input type="hidden" name="y1" value="" />
      <input type="hidden" name="w" value="" />
      <input type="hidden" name="h" value="" /><br><br>
      <input type="submit" name="submit" value="Submit" />
  </form>
 
  <p><img id="previewimage" style="display:none;"/></p>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="js/jquery_.min.js"></script> --}}
<script src="{{ mix('js/jquery.min.js') }}" defer></script>
<script src="js/jquery.imgareaselect.min.js"></script>
<script src="{{ mix('js/jquery.imgareaselect.js') }}" defer></script>
{{-- <script>
    jQuery(function($) {
 
        var p = $("#previewimage");
        $("body").on("change", "#image", function(){
 
            var imageReader = new FileReader();
            imageReader.readAsDataURL(document.getElementById("image").files[0]);
     
            imageReader.onload = function (oFREvent) {
                p.attr('src', oFREvent.target.result).fadeIn();
            };
        });
 
        $('#previewimage').imgAreaSelect({
            onSelectEnd: function (img, selection) {
                $('input[name="x1"]').val(selection.x1);
                $('input[name="y1"]').val(selection.y1);
                $('input[name="w"]').val(selection.width);
                $('input[name="h"]').val(selection.height);            
            }
        });
    });
</script> --}}
</body>
</html>