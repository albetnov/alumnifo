<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Delete extends Component
{
    public function render()
    {
        return view('livewire.user.delete')->layout('guest');
    }
}
