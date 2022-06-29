<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ban;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\Gig;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Users
        $users = User::get();

        // Clients
        $clients = Client::get();

        // Freelancer
        $freelancers = Freelancer::get();

        // Ban
        $ban = Ban::get();

        // Gigs
        $gig = Gig::get();

        //Gigs completed
        $jobs = Job::where('verdict', 'Approve')->get();

        return view('admin.index', [
            'users' => $users,
            'clients' => $clients,
            'freelancers' => $freelancers,
            'ban' => $ban,
            'gig' => $gig,
            'jobs' => $jobs,
        ]);
    }

    public function index_add()
    {
        return view('admin.add');
    }

    public function add_admin(Request $request)
    {
        // Validate
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        //Create new user admin
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user' => 'admin'
        ]);

        $user = User::orderBy('created_at', 'desc')->first();
        //dd($user);

        // Add new user to admin table
        Admin::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('dashboard')->with('admin_created', 'New admin created');
    }

    public function edit_admin()
    {
        $admins = Admin::get();
        return view('admin.edit', [
            'admins' => $admins
        ]);
    }

    public function update_admin(Admin $admin)
    {
        return view('admin.update', [
            'admin' => $admin
        ]);
    }

    public function delete_admin(Admin $admin)
    {
        $admin->user->delete();

        return redirect()->route('edit.admin')->with('admin_deleted', 'Admin user deleted');
    }

    public function post_update(Admin $admin, Request $request)
    {
        //dd($admin);

        // Validate
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $admin->user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('edit.admin')->with('admin_updated', 'Admin user updated');
    }

    public function gig_ban(Request $request)
    {
        $search = "";
        $gigs = "";
        if ($request->search) {
            $search = $request->search;
            $gigs = Gig::where('title', 'LIKE', '%' . $search . '%')->get();
            return view('admin.gigs', [
                'gigs' => $gigs
            ]);
        } else {
            $gigs = Gig::where('title', 'LIKE', '%' . $search . '%')->get();
            return view('admin.gigs', [
                'gigs' => $gigs
            ]);
        }
        // $gigs = Gig::where('title', 'LIKE', '%' . 'mob' . '%')->get();
        // dd($gigs);
    }

    public function ban(Gig $gig)
    {
        $gig->ban()->create();

        return back()->with('banned', 'Gig ' . $gig->title . ' has been banned');
    }
}
