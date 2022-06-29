<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function delete(Application $application, User $user)
    {
        dd($application);
        // $application->delete();

        // return redirect()->route('profile.freelancer', $user)->with('deleted', 'Application deleted successfully');
    }

    public function index(Gig $gig)
    {
        //dd($gig->application);
        return view('application.index', [
            'gig' => $gig
        ]);
    }

    // Accept application
    public function accept(Application $application, Request $request)
    {
        //dd($application);
        $application->update([
            'status' => $request->accepted
        ]);

        return redirect()->route('view.applications', $application->gig)->with('accepted', 'Application has been accepted. Now wait for the freelancer to get in touch :)');
    }

    // Decline application
    public function decline(Application $application)
    {
        dd($application);
    }

    // Download application
    public function download(Application $application)
    {
        return response()->download(public_path("docs") . "/" . $application->proposal);
    }
}
