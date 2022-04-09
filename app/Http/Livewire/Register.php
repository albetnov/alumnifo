<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name'     => 'required|min:3',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:3',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function register()
    {
        if (RateLimiter::tooManyAttempts('login', 3)) {
            $seconds = RateLimiter::availableIn('login');

            return session()->flash('message', 'Percobaan terlalu banyak. Akses ditolak selama: '.$seconds.' detik');
        }
        if (RateLimiter::remaining('login', 3)) {
            RateLimiter::hit('login');
        }

        $validateData = $this->validate();
        $user = User::create([
            'name'     => $validateData['name'],
            'email'    => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);
        $user->assignRole('disabled');
        Auth::login($user);

        return to_route('disabled.dashboard')->with('message', 'Welcome To Dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('livewire.auth.layouts.main');
    }
}
