<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Kerja;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;
use Livewire\WithPagination;

class IndexKerja extends Component
{
    use WithPagination, BaseTable;

    protected $paginationTheme = 'bootstrap';
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
        $kerjas = $this->baseRender(Kerja::class, 'name', 'nama_perusahaan', 'jabatan', 'tahun_kerja')->paginate(10);
        return view('livewire.tables.kerja.index', compact('kerjas'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Kerja']);
    }
}
