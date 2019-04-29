<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = new User;

        $s = $request->s ? $request->s : null;
        $of = $request->order_field ? $request->order_field : 'id';
        $od = $request->order_direction ? $request->order_direction : 'desc';
        $users = $user->search($s)
            ->orderBy($of, $od)
            ->paginate(5);

        $data = [
            'users' => $users,
            'order_field' => $of,
            'order_direction' => $od,
            's' => $s,
        ];

        return view('dashboard')->with('users',$data);
    }
}
