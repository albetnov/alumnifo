<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Models\Kerja;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class IndexKerja extends Component
{
    public $imgPreview = false, $name;

    private function cleanup()
    {
        if ($this->imgPreview) {
            $this->imgPreview = false;
            $this->name = "";
        }
    }

    public function openImg($id)
    {
        $this->cleanup();
        try {
            $data = Kerja::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return;
        }
        $this->imgPreview = $data->gambar;
        $this->name = $data->name;
        $this->emit('openModal', 'imgPreview');
    }

    public function render()
    {
        return view('livewire.tables.kerja.index', ['kerjas' => Kerja::get()])->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Kerja']);
    }
}
