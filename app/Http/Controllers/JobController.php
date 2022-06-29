<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Contract;
use App\Models\Gig;
use App\Models\Job;
use App\Models\Payment;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Gig $gig)
    {
        //dd($gig->job[0]['price']);
        //$paid = $gig
        return view('job.work', [
            'gig' => $gig
        ]);
    }

    public function active()
    {

        $jobs = auth()->user()->job;
        //dd($gigs->count());
        return view('job.active', [
            'jobs' => $jobs
        ]);
    }

    public function view()
    {
        //dd(auth()->user()->application[0]->contract);
        $applications = Application::where('user_id', auth()->user()->id)->get();
        return view('contract.view', [
            'applications' => $applications
        ]);
    }

    public function payment(Job $job)
    {
        // $paid = $user->job->where('price' . '=' . 'paid');
        return view('payments.page', [
            'job' => $job,
        ]);
        //dd($job);
    }

    public function pay(Job $job)
    {
        return view('payments.pay', [
            'job' => $job
        ]);
    }

    public function complete(Request $request, Job $job)
    {
        // Validate
        $this->validate($request, [
            'amount' => 'required',
        ]);

        if ($job->price != $request->amount) {
            return back()->with('no_match', 'The amount paid must be equal to the fee for the job!');
        } else {

            // Payments table
            Payment::create([
                'user_id' => auth()->user()->id,
                'job_id' => $job->id,
                'payment_method' => 'mobile money',
                'amount' => $request->amount
            ]);

            // $work = 'work' . '-' . auth()->user()->username . "." . $request->file->extention();
            // $request->file->move(public_path('docs'), $work);


            // Update job table
            $job->update([
                // 'work' => $work,
                'paid' => $request->amount,
                'status' => 'pending'
            ]);

            return back()->with('paid', 'Job has been successfully paid for!');
        }
    }

    public function begin(Request $request, Job $job)
    {
        if ($job->paid == 0) {
            return back()->with('incomplete', 'You cant begin working before client deposits funds for gig');
        } else {
            $job->update([
                'status' => $request->begin
            ]);

            //$jobs = auth()-user()->job;
            return back()->with('begin', 'You can commence with ' . $job->gig->title . ' gig');
        }

        //dd($request->all());
    }

    // Completing a job

    public function complete_job(Request $request, Job $job)
    {

        // Validate

        $this->validate($request, [
            'file' => 'required|file|mimes:docx,doc,pdf'
        ]);

        $newDoc = 'gig' . "-" . auth()->user()->username . "." . $request->file->extension();
        $request->file->move(public_path('docs'), $newDoc);

        // Update job

        $job->update([
            'work' => $newDoc,
            'status' => $request->submit
        ]);

        return back()->with('completed', 'Job completed.');
    }

    // Approve submission

    public function approve(Job $job)
    {
        // $reviews = Reviews::where('user_id', auth()->user()->id)->get();
        return view('job.approve', [
            'job' => $job,
        ]);
        //dd($reviews);
    }

    // Download work

    public function download_work(Job $job)
    {
        // dd($job);
        return response()->download(public_path('docs') . "/" . $job->work);
    }

    // Approve work

    public function approve_work(Request $request, Job $job)
    {
        // dd($job);

        $job->update([
            'verdict' => $request->approve
        ]);

        return back()->with('approved', 'Job has been approved');
    }

    // Rate freelancers work

    public function review(Request $request, User $user)
    {
        // Validate
        $this->validate($request, [
            'body' => 'required',
            'rating' => 'required'
        ]);

        // Create a review
        Reviews::create([
            'user_id' => $user->id,
            'body' => $request->body,
            'rating' => $request->rating
        ]);

        // // Update freelancers table
        $reviews = Reviews::where('user_id', $user->id)->avg('rating');
        $reviews = substr($reviews, 0, 3);
        $user->freelancer()->update([
            'rating' => $reviews
        ]);

        return back()->with('rate', 'Freelancer ' . $user->username . ' has successfully been rated');

        //dd(substr($reviews, 0, 3));
    }

    // Rating successful

    public function rate()
    {
        return view('rate.index');
    }

    // Rate client

    public function rate_client(Gig $gig)
    {
        return view('rate.rate', [
            'gig' => $gig
        ]);
    }

    public function post_rating(Request $request, Gig $gig)
    {
        // Validate
        $this->validate($request, [
            'body' => 'required',
            'rating' => 'required'
        ]);

        // Create a review
        Reviews::create([
            'user_id' => $gig->user->id,
            'body' => $request->body,
            'rating' => $request->rating
        ]);

        // Update Job table

        //dd($gig->job);
        $gig->job()->update([
            'rate' => $request->rating
        ]);

        // Update Clients table
        $reviews = Reviews::where('user_id', $gig->user->id)->avg('rating');
        $reviews = substr($reviews, 0, 3);
        $gig->user->client()->update([
            'average_rating' => $reviews
        ]);

        return redirect()->route('rate.client', ['gig' => $gig])->with('rate', 'Client ' . $gig->user->username . ' has successfully been rated');

        //dd($user->client);
    }
}
