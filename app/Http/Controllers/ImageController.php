<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
    	    	
        if ($request->hasFile('image')) {

            $imageName = $request->image->getClientOriginalName();

            $request->image->storeAs('public/profile_images/crops', $imageName);

            $thumbnailpath = public_path('storage/profile_images/crops/'.$imageName);
            $img = Image::make($thumbnailpath)->crop($request->w, $request->h, $request->x1, $request->y1);
            $img->save($thumbnailpath);  

       	// 	$img = Image::make($filepath);
       	// 	$croppath = 'images/crop/'. $filename;
        //     $croppath = public_path('storage/profile_images/crops/'.$imageName);

      		// $img->crop($request->w, $request->h, $request->x1, $request->y1);
      		// $img->save($croppath);
              
        }

    }

    public function uploadImage(Request $request){

    	// var_dump("expression");
    	
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        // $image_name= time().'.png';
        $image_name= 'GGGGGGGGGGGG.png';

        $path = public_path('storage/profile_images/'.$image_name);


        file_put_contents($path, $data);


        return response()->json(['success'=>'done']);
    }
}	