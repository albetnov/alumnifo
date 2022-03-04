<?php

namespace App\Http\Livewire;

use App\Models\PublicContact;
use Livewire\Component;
use App\Models\Teams;

class Home extends Component
{
    public $name, $email, $subject, $contactMessage;

    protected $rules = [
        'name' => 'required|min:3|max:64',
        'email' => 'required|email|max:64',
        'subject' => 'required|max:64',
        'contactMessage' => 'required'
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    private function emptyField()
    {
        $this->name = "";
        $this->email = "";
        $this->subject = "";
        $this->contactMessage = "";
    }

    public function sendContact()
    {
        $validated = $this->validate();
        PublicContact::create($validated);
        $this->emptyField();
        $this->emit('showAlert', 'success', 'Pesan berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.home', ['teams' => Teams::get()])->layout('guest');
    }
}
