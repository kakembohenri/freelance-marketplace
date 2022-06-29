<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;

class GigController extends Controller
{
    public function index()
    {
        return view('gig.create');
    }

    public function details()
    {
        return view('gig.gig_details');
    }

    public function my_gig()
    {
        $user = auth()->user()->id;
        $gigs = Gig::latest()->where('user_id', $user)->get();
        return view('gig.my_gigs', [
            'gigs' => $gigs
        ]);
        //dd($gigs);
    }

    public function active()
    {
        return view('gig.active_gigs');
    }

    // Creating a gig

    public function create_gig(Request $request)
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'location' => 'required',
            'payment_mode' => 'required',
            'avatar' => 'required|mimes::jpg,png,jpeg',
            'price' => 'required',
            'status' => 'required'
        ]);

        $newImageName = 'gig pic' . '-' . $request->title . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('img'), $newImageName);

        //create gig

        Gig::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'avatar' => $newImageName,
            'description' => $request->description,
            'duration' => $request->duration,
            'location' => $request->location,
            'payment_mode' => $request->payment_mode,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return redirect()->route('my_gigs')->with('create_gig', 'New gig created');
    }

    // Update gigs
    public function update_gig(Gig $gig)
    {
        return view('update.gig', [
            'gig' => $gig
        ]);
        //dd($gig);
    }

    public function edit_gig(Request $request, Gig $gig)
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'avatar' => 'required|mimes::jpg,png,jpeg',
            'description' => 'required',
            'duration' => 'required',
            'location' => 'required',
            'payment_mode' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $newImageName = 'gig pic' . '-' . $request->title . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('img'), $newImageName);

        //Update gig
        // $user = auth()->user();
        //dd($request->title);
        $gig->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'avatar' => $newImageName,
            'description' => $request->description,
            'duration' => $request->duration,
            'location' => $request->location,
            'payment_mode' => $request->payment_mode,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return redirect()->route('my_gigs')->with('gig_updated', 'Gig has succefully been updated');
    }

    // Delete gig

    public function delete_gig(Gig $gig)
    {
        $gig->delete();

        return back()->with('gig_deleted', 'Gig successfully deleted');
    }

    // Apply gig

    public function apply(Gig $gig)
    {
        //dd($gig->application[0]['user_id']);
        return view('gig.gig_apply', [
            'gig' => $gig
        ]);
    }

    //Apply for a gig
    public function apply_gig(Gig $gig, Request $request)
    {
        // Validate
        $this->validate($request, [
            'proposal' => 'required|file|mimes:docx,doc,pdf'
        ]);

        $newDocName = 'proposal' . '-' . auth()->user()->username . '.' . $request->proposal->extension();
        //dd($newDocName);
        $request->proposal->move(public_path('docs'), $newDocName);
        //dd($request->proposal);

        Application::create([
            'user_id' => auth()->user()->id,
            'gig_id' => $gig->id,
            'proposal' => $newDocName,
        ]);

        return redirect()->route('home')->with('applied', 'Successfully applied for gig ' . $gig->title);
    }
}
