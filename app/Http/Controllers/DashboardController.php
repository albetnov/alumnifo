<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function logout()
    {
        Auth::logout();
        request()->session()->regenerate();

        return to_route('home');
    }
}
