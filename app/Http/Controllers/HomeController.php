<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }
    public function index(Request $request)
    {
        if ($request->search_gig) {
            // Search for gigs
            $search = $request->search_gig;
            $gigs = Gig::where('title', 'LIKE', '%' . $search . '%')->get();

            return view('home', [
                'gigs' => $gigs
            ]);
        } elseif ($request->search_freelancer) {
            // Search for freelancers
            $search = $request->search_freelancer;
            $freelancers = Freelancer::where('main_skill', 'LIKE', '%' . $search . '%')->orderBy('rating', 'desc')->get();


            return view('home', [
                'freelancers' => $freelancers
            ]);


            //dd(url('/home') == url()->current());
        } else {

            //Freelancers
            $freelancers = Freelancer::get();

            //Clients
            $gigs = Gig::get();

            return view('home', [
                'freelancers' => $freelancers,
                'gigs' => $gigs
            ]);
        }
    }
}
