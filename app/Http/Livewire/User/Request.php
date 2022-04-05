<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Request extends Component
{
    public function render()
    {
        return view('livewire.user.request')->layout('guest');
    }
}
