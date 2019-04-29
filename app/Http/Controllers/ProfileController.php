<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $user['address_map'] = str_replace(' ', '%20', $user['address']);
        return view('profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $gender= ['Male','Female'];
        $education= ['Elementary','High School','College','Master','Professional Doctorate'];

        return view('profile-edit')
            ->with('profileEdit',$user)
            ->with('gender',$gender)
            ->with('education',$education);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|max:255|unique:users,email,'.$id,
            'gender' => ['required', 'string', 'max:255'],
            'education' => ['required'],
            'address' => ['required'],
            'description' => ['required'],
        ]);
 
        $user = User::find($id);

        if ($request->hasFile('avatar')) {
            $imageName = $request->email . '.' . $request->avatar->getClientOriginalExtension();      

            if ($request->img_val) {
                 $cropImage = $request->img_val;
                list($type, $cropImage) = explode(';', $cropImage);
                list(, $cropImage)      = explode(',', $cropImage);
                $cropImage = base64_decode($cropImage);
                $path = public_path('storage/profile_images/'.$imageName);
                file_put_contents($path, $cropImage);
                $request->avatar->storeAs('public/profile_images/orig_images', $imageName);
            } 
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->education = $request->education;
        // $user->avatar = $imageName;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->save();
        return redirect()->route('profile');
    }   
}
