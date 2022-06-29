<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\GigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LogoutUserController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserProfileController;
use App\Models\Job;
use DebugBar\DataCollector\MessagesCollector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/showcase', function () {
    return view('welcome');
})->name('welcome');

Route::get('', function () {
    return redirect()->route('welcome');
});

// Account verification
//Auth::routes(['verify' => true]);

//Register
Route::get('/showcase/register', [RegisterUserController::class, 'index'])->name('register');

// Register as freelancer
Route::post('/showcase/register/freelancer', [RegisterUserController::class, 'register_freelancer'])->name('register.freelancer');

// Register as client
Route::post('/showcase/register/client', [RegisterUserController::class, 'register_client'])->name('register.client');

//Get and edit profile freelancer
Route::get('/showcase/profile/freelancer/{user:username}', [FreelancerController::class, 'index'])->name('freelancer');
//Route::post('profile/freelancer', [FreelancerController::class, 'edit'])->name('freelancer.enhance');

//Get and edit profile client
Route::get('/showcase/profile/{user:username}', [UserProfileController::class, 'index'])->name('profile');

Route::get('/showcase/profile/edit/{user:username}', [ClientUserController::class, 'edit'])->name('edit.client');

//Update client
//Route::any('/profile/{user:username}/edit/about', [ClientUserController::class, 'about'])->name('update.about');

//Login
Route::get('/showcase/login', [UserLoginController::class, 'index'])->name('login');
Route::post('/showcase/login', [UserLoginController::class, 'login']);

//Logout
Route::post('/showcase/logout', [LogoutUserController::class, 'logout'])->name('logout');

// Profile
//Route::get('/profile/freelancer/{user:username}', [UserProfileController::class, 'index'])->name('profile.freelancer');

// // Edit profile
// Route::get('/profile/edit', [UserProfileController::class, 'edit_profile']);


//Home page
Route::get('/showcase/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');


// Gig create
Route::get('showcase/gig/create', [GigController::class, 'index'])->name('create.gig');
Route::post('showcase/gig/create', [GigController::class, 'create_gig']);


//Gig details
Route::get('gig/details', [GigController::class, 'details']);

//My gig
Route::get('/showcase/my-gigs', [GigController::class, 'my_gig'])->name('my_gigs');


//Update gig
Route::get('showcase/gig/my_gigs/update/{gig}', [GigController::class, 'update_gig'])->name('update.gig');
Route::post('showcase/gig/my_gigs/update/{gig}', [GigController::class, 'edit_gig'])->name('edit.gig');
Route::delete('showcase/gig/my_gigs/delete/{gig}', [GigController::class, 'delete_gig'])->name('delete.gig');


//Active gigs
Route::get('showcase/gig/active', [GigController::class, 'active']);

//Apply for gig
Route::get('showcase/gig/apply/{gig}', [GigController::class, 'apply'])->name('apply');
Route::post('showcase/gig/apply/{gig}', [GigController::class, 'apply_gig']);

//Delete application
Route::delete('/application/delete/{application}', [ApplicationController::class, 'delete'])->name('application.delete');

//Download application
Route::get('/application/download/{application}', [ApplicationController::class, 'download'])->name('download');


//View applications
Route::get('/showcase/my-gigs/{gig}/applications', [ApplicationController::class, 'index'])->name('view.applications');

//Accept application
Route::post('showcase/application/{application}/accept', [ApplicationController::class, 'accept'])->name('accept.application');
Route::post('showcase/application/{application}/decline', [ApplicationController::class, 'decline'])->name('decline.application');

//Contract
Route::get('showcase/contract/{application}', [ContractController::class, 'index'])->name('contract');
Route::post('showcase/contract/accept/{application}', [ContractController::class, 'accept'])->name('contract.submit');
Route::get('showcase/contract/get/{contract}', [ContractController::class, 'download'])->name('download.contract');

//View contract freelancer
Route::get('/contract/freelancer/view/{gig}', [ContractController::class, 'freelancer_contract'])->name('freelancer.contract');
Route::post('/contract/freelancer/accept/{contract}', [ContractController::class, 'freelancer_accept'])->name('contract.accept.freelancer');
Route::post('/contract/freelancer/declined/{contract}', [ContractController::class, 'freelancer_decline'])->name('contract.decline.freelancer');

//Work
//Route::get('/work/{gig}', [JobController::class, 'index'])->name('work');
Route::get('showcase/jobs/active', [JobController::class, 'active'])->name('active.job');

//Freelancer view contracts
Route::get('showcase/contracts', [JobController::class, 'view'])->name('contracts.view');

//Payments
//Route::get('/payments/{job}', [JobController::class, 'payment'])->name('payments');

// Pay
//Route::get('pay/{job}', [JobController::class, 'pay'])->name('pay');
Route::post('showcase/pay/{job}', [JobController::class, 'complete'])->name('pay');

//Messages
Route::get('showcase/messages', [MessagesController::class, 'index'])->name('messages');
Route::get('showcase/messages/inbox/{user}', [MessagesController::class, 'inbox'])->name('inbox');
Route::post('showcase/messages/send/{user:username}/message', [MessagesController::class, 'send'])->name('message.send');


//Admin
Route::get('showcase/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

//Add admin
Route::get('showcase/admin/dashboard/add/admin', [AdminController::class, 'index_add'])->name('register.admin');
Route::post('showcase/admin/dashboard/add/admin', [AdminController::class, 'add_admin']);

//Edit admin
Route::get('showcase/admin/dashboard/edit', [AdminController::class, 'edit_admin'])->name('edit.admin');

//Update admin
Route::get('showcase/admin/update/{admin}', [AdminController::class, 'update_admin'])->name('admin.update');
Route::post('showcase/admin/update/{admin}', [AdminController::class, 'post_update']);

//Delete admin
Route::post('showcase/admin/delete/{admin}', [AdminController::class, 'delete_admin'])->name('admin.delete');

// Edit gigs
Route::get('showcase/admin/manage-gigs/', [AdminController::class, 'gig_ban'])->name('gig.ban');

//Ban
Route::post('showcase/admin/ban/{gig}', [AdminController::class, 'ban'])->name('ban');

// Begin job
Route::post('showcase/begin/{job}', [JobController::class, 'begin'])->name('begin');

// Complete job
Route::post('showcase/complete/job/{job}', [JobController::class, 'complete_job'])->name('job.complete');

// Approve job
Route::get('showcase/approve/job/{job}', [JobController::class, 'approve'])->name('approve');

// Download work
Route::get('showcase/download/work/{job}', [JobController::class, 'download_work'])->name('download.work');

//Approve work
Route::post('/approve/work/{job}', [JobController::class, 'approve_work'])->name('approve.work');

//Review
Route::post('/review/{user}', [JobController::class, 'review'])->name('review');

// Rate index
Route::get('/rating-success', [JobController::class, 'rate'])->name('rate');

// Rate client
Route::get('showcase/rate/client/gig/{gig}', [JobController::class, 'rate_client'])->name('rate.client');
Route::post('showcase/rate/client/{gig}', [JobController::class, 'post_rating'])->name('post.rating');
