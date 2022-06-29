<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        //$messages = Messages::where('user_from', auth()->user()->id)->orwhere('user_to', auth()->user()->id)->get();
        $users = User::get();
        $user_to = Messages::select('user_from')->where('user_to', auth()->user()->id)->distinct()->get();
        $user_from = Messages::select('user_to')->where('user_from', auth()->user()->id)->distinct()->get();
        return view('messages.index', [
            'user_to' => $user_to,
            'user_from' => $user_from,
            'users' => $users
        ]);
        //dd($user_from);
    }

    public function inbox(User $user)
    {
        //dd($user);
        $messages = Messages::get();
        return view('messages.inbox', [
            'user' => $user,
            'messages' => $messages
        ]);
        //dd($messages);
    }

    public function send(User $user, Request $request)
    {
        // Validate
        $this->validate($request, [
            'body' => 'required'
        ]);

        //Create message
        Messages::create([
            'user_from' => auth()->user()->id,
            'user_to' => $user->id,
            'body' => $request->body
        ]);

        return back();
    }
}
