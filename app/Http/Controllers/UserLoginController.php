<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //Validate

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid credentials');
        }

        // Check for the user in the admin table

        $admin = Admin::where('user_id', auth()->user()->id)->get();
        if ($admin->count() != 0) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
        //dd($admin);
    }
}
