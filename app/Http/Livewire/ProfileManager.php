<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileManager extends Component
{
    public $name;
    public $password;
    public $conpass;
    public $email;
    public $passwordEdited = false;

    protected function rules()
    {
        return [
            'name'     => 'required',
            'password' => 'nullable|min:8',
            'conpass'  => 'same:password',
            'email'    => 'required|email|unique:users,id,'.Auth::user()->id,
        ];
    }

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedPassword()
    {
        $this->passwordEdited = true;
    }

    public function updatedConpass()
    {
        $this->passwordEdited = true;
    }

    public function resetForm()
    {
        $this->password = "";
        $this->conpass = "";
        $this->passwordEdited = false;
    }

    public function edit()
    {
        $this->validate();
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
        ];
        if ($this->passwordEdited) {
            $data['password'] = bcrypt($this->password);
        }
        User::find(Auth::user()->id)->update($data);
        $this->resetForm();
        $this->emit('showAlert', 'success', 'Profile edited successfully.');
    }

    public function render()
    {
        return view('livewire.profile-manager')->layout('livewire.layouts.main', ['href' => 'Main', 'name' => 'Profile']);
    }
}
