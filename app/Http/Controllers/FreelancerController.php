<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index()
    {
        return view('if.freelancer');
    }

    public function edit(Request $request)
    {
        //Validate

        //dd($request->student_reg_no);
        $this->validate($request, [
            'student_reg_no' => 'required|unique:freelancers|max:14',
            'bio' => 'max:100',
            'main_skill' => 'required',
            'other_skills' => 'max:50'
        ]);

        // Update new freelancer
        $freelancer = Freelancer::where('user_id', auth()->user()->id);
        $freelancer->update([
            'student_reg_no' => $request->student_reg_no,
            'about' => $request->bio,
            'price' => $request->fee,
            'main_skill' => $request->main_skill,
            'skills' => $request->other_skills
        ]);

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('profile.freelancer', ['user' => auth()->user()]);
    }
}
