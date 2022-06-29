<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Contract;
use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Application $application)
    {
        //dd($application->gig->user);
        return view('contract.index', [
            'application' => $application
        ]);
    }

    public function accept(Request $request, Application $application)
    {
        //dd($request->contract);

        $this->validate($request, [
            'contract' => 'required|file|mimes:docx,doc,pdf'
        ]);

        $newDoc = 'contract' . "-" . auth()->user()->username . "." . $request->contract->extension();
        $request->contract->move(public_path("docs"), $newDoc);

        //dd($request->contract->move(public_path('docs'), $newDoc));
        $application->contract()->create([
            'contract' => $newDoc,
            'status' => 'pending'
        ]);

        return redirect()->route('view.applications', ['gig' => $application->gig])->with('contract', 'Contract submitted please wait for feedback from freelancer');
    }

    public function freelancer_contract(Gig $gig)
    {
        return view('contract.view', [
            'gig' => $gig
        ]);
        //dd($gig->application[0]->contract);
    }

    // Freelancer accepts contract
    public function freelancer_accept(Contract $contract, Request $request)
    {

        //dd($contract);

        // Update contract status to 'Accepted'
        $contract->update([
            'status' => $request->accepted
        ]);

        // Create new job
        $contract->application->gig->job()->create([
            'user_id' => auth()->user()->id,
            'price' => $contract->application->gig->price,
            'work' => 'none',
            'paid' => 0,
            'status' => 'pending',
            'verdict' => 'pending',
            'rate' => 'none'
        ]);

        return redirect()->back()->with('contract_accept', 'Contract accepted. Now wait for the job to paid for before you can commence with the job');
    }

    public function freelancer_decline(Contract $contract, Request $request)
    {
        $contract->update([
            'status' => $request->declined
        ]);

        return redirect()->back()->with('contract_declined', 'Contract declined. You can always discuss with your client to arrange new terms');
    }

    // Download contract
    public function download(Contract $contract)
    {
        return response()->download(public_path("docs") . "/" . $contract->contract);
    }
}
