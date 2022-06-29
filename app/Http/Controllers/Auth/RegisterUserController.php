<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\Reg_Number;
use App\Models\reg_numbers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterUserController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function confirm_account(Request $request)
    {

        dd($request->all());
        // $user = $request->all();

        // $email = $request->email;

        // Mail::to($email)->send(new UserRegistered($user));

        // return back()->with('confirm', 'Check your email address to complete registration');
    }
    public function register_freelancer(Request $request)
    {
        $student_number = '';
        $result = '';
        $student_number = $request->student_reg_no;
        $result = reg_numbers::where('reg_number', $student_number)->get();

        // Validate
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'location' => 'required',
            'password' => 'required|confirmed',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'image' => 'required|mimes:jpg,png,jpeg',
            'student_reg_no' => 'required|unique:freelancers|between:13,14',
            'fee' => 'required',
            'bio' => 'required',
            'main_skill' => 'required',
            'other_skills' => 'required'
        ]);

        if ($result->count() > 0) {

            $newImageName = 'profile pic' . '-' . $request->username . '.' . $request->image->extension();

            $request->image->move(public_path('img'), $newImageName);

            //Create user
            User::create([
                'first_name' => $request->fname,
                'last_name' => $request->lname,
                'gender' => $request->gender,
                'location' => $request->location,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user' => 'freelancer',
                'image_path' => $newImageName
            ]);


            auth()->attempt($request->only('username', 'password'));

            Freelancer::create([
                'user_id' => auth()->user()->id,
                'student_reg_no' => $request->student_reg_no,
                'about' => $request->bio,
                'price' => $request->fee,
                'main_skill' => $request->main_skill,
                'skills' => $request->other_skills
            ]);

            return redirect()->route('home');
        } else {
            return back()->with('exist', 'Student with student number ' . $request->student_reg_no . ' doesnt exist');
        }
    }

    public function register_client(Request $request)
    {
        // Validate
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'gender' => 'required',
            'location' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'bio' => 'max:100',
        ]);

        $newImageName = 'profile pic' . '-' . $request->fname . " " . $request->lname . '.' . $request->image->extension();

        $request->image->move(public_path('img'), $newImageName);

        //Create user
        User::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'gender' => $request->gender,
            'location' => $request->location,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user' => 'client',
            'image_path' => $newImageName
        ]);

        auth()->attempt($request->only('username', 'password'));

        //Client
        Client::create([
            'user_id' => auth()->user()->id,
            'about' => $request->bio,
        ]);

        return redirect()->route('home');
    }
}
