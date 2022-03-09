<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:3',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function register()
    {
        $validateData = $this->validate();
        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);

        return redirect()->route('dashboard')->with('message','Welcome To Dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('livewire.auth.layouts.main');
    }
}
