<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:3',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function login()
    {
        $validateData = $this->validate();
        if (Auth::attempt($validateData)) {
            request()->session()->regenerate();
            if (Auth::guard()->user()->hasRole('SuperAdmin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
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
