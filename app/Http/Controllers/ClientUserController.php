<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Job;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class ClientUserController extends Controller
{
    public function index(User $user)
    {
        $jobs = Job::get();
        return view('profile.client', [
            'user' => $user,
            'jobs' => $jobs
        ]);
        // $reviews = Reviews::get();
        //dd($user->gig[1]);
    }

    public function edit(User $user)
    {
        // return view('update.client', [
        //     'user' => $user
        // ]);
        dd('Go back this isnt necessary');
    }

    //Updating fields for client

    public function about(User $user, Request $request)
    {
        // Validate
        $this->validate($request, [
            'about' => 'required'
        ]);

        //Update about 
        //dd($user->client[0]['about']);
        //dd($request->about);

        $user->client()->update(['about' => $request->about]);

        return redirect()->route('client', $user)->with('about', 'Successfully updated about');
    }
}
