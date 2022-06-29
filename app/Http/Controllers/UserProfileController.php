<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $jobs = Job::get();
        return view('profile.user_profile', [
            'user' => $user,
            'jobs' => $jobs,

        ]);
        //dd($paid);
    }

    public function edit_profile()
    {
        return view('update.freelance');
    }
}
