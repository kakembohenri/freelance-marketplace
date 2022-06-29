<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutUserController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('welcome');
    }
}
