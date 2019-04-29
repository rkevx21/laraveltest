<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'description' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\user
     */
    protected function create(array $data)
    {
        $imageName="";
        if (isset($data['avatar']) && $data['avatar'] == true) {
                 // $imageName = $data['avatar']->getClientOriginalName();
            $imageName = $data['email'] . '.' . $data['avatar']->getClientOriginalExtension();

            // $data['avatar']->storeAs('public',$imageName);
            // $data['avatar']->storeAs('public/thumbnail', $imageName);

        //Upload File
        $data['avatar']->storeAs('public/profile_images', $imageName);
        $data['avatar']->storeAs('public/profile_images/thumbnails', $imageName);
 
        //Resize image here
        $thumbnailpath = public_path('storage/profile_images/thumbnails/'.$imageName);
        $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
 
            // $thumbnailpath = public_path('/thumbnail/'.$imageName);
            // $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            // $constraint->aspectRatio();});
            // $img->save($thumbnailpath);
        }        
        


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'avatar' => $imageName,
            'address' => $data['address'],
            'description' => $data['description'],
        ]);
    }
}
