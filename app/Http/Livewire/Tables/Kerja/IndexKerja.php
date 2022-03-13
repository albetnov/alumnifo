<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Models\Kerja;
use Livewire\Component;

class IndexKerja extends Component
{
    public function render()
    {
        return view('livewire.tables.kerja.index', ['kerjas' => Kerja::get()])->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Kerja']);
    }
}
