<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
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

        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|max:255|unique:users,email,'.$id,
            'gender' => ['required', 'string', 'max:255'],
            'education' => ['required'],
            'address' => ['required'],
            'description' => ['required'],
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->education = $request->education;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->save();
        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request, $id)
    {
    	$user = User::find($id);
    	$user->delete();
    	$request->session()->flash('success', __('User #' . $id . ' has been successfully deleted'));
    	return redirect()->route('admin.dashboard');
    }
}
