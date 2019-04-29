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
            'gender' => ['required'],
            'education' => ['required'],
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
        if (isset($data['img_val']) && $data['img_val'] == true) {

            $imageName = $data['email'] . '.' . $data['avatar']->getClientOriginalExtension();
            $cropImage = $data['img_val'];
            list($type, $cropImage) = explode(';', $cropImage);
            list(, $cropImage)      = explode(',', $cropImage);
            $cropImage = base64_decode($cropImage); 
            
            $path = public_path('storage/profile_images/'.$imageName);  
            file_put_contents($path, $cropImage);  
            $data['avatar']->storeAs('public/profile_images/orig_images', $imageName);
        }
    
        else{
            $imageName="default.png";
        }       

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'education' => $data['education'],
            'avatar' => $imageName,
            'address' => $data['address'],
            'description' => $data['description'],
        ]);
    }

}
