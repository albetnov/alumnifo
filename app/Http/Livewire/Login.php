<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:3',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function login()
    {
        $validateData = $this->validate();
        if (RateLimiter::remaining('login', 3)) {
            RateLimiter::hit('login');
        }
        if (RateLimiter::tooManyAttempts('login', 3)) {
            $seconds = RateLimiter::availableIn('login');

            return session()->flash('message', 'Percobaan terlalu banyak. Akses ditolak selama: ' . $seconds . ' detik');
        }
        if (Auth::attempt($validateData)) {
            request()->session()->regenerate();
            if (Auth::guard()->user()->hasRole('SuperAdmin')) {
                return to_route('admin.dashboard');
            } else if (Auth::guard()->user()->hasRole('disabled')) {
                return to_route('disabled.dashboard');
            } else {
                return to_route('home');
            }
        } else {
            session()->flash('message', 'Your Email or Password are Incorrect');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('livewire.auth.layouts.main');
    }
}
