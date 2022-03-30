<?php

namespace App\Http\Livewire\Tables\KerjaKuliah;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\KerjaKuliah;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class IndexKerjaKuliah extends Component
{
    use WithPagination;
    use BaseTable;
    use BulkDelete;

    protected $paginationTheme = 'bootstrap';
    public $imgPreview = false;
    public $name;
    public $deleteOpened = false;
    public $selectedId;

    public function mount()
    {
        $this->setModel(KerjaKuliah::class);
        $this->hasPhoto(true, 'kerjakuliah');
    }

    public function updated($fields)
    {
        $this->updatedBulk($fields);
        $this->updatedBase($fields);
    }

    private function cleanup()
    {
        if ($this->imgPreview) {
            $this->imgPreview = false;
            $this->name = "";
        }
        if ($this->deleteOpened) {
            $this->name = "";
            $this->selectedId = "";
        }
    }

    public function openImg($id)
    {
        $this->cleanup();

        try {
            $data = KerjaKuliah::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Gagal mendapat data');

            return;
        }
        $this->imgPreview = $data->gambar;
        $this->name = $data->name;
        $this->emit('openModal', 'imgPreview');
    }

    public function openDelete($id)
    {
        $this->cleanup();

        try {
            $data = KerjaKuliah::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Gagal mendapat data');

            return;
        }
        $this->deleteOpened = true;
        $this->name = $data->name;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function deleteData()
    {
        try {
            $find = KerjaKuliah::find($this->selectedId)->firstOrFail();
            if ($find->gambar) {
                Storage::disk('public')->delete('kerjakuliah/'.$find->gambar);
            }
            $find->delete();
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. '.$q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: '.$e->getMessage());

            return;
        }
        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function render()
    {
        $dataKerjaKuliah = $this->baseRender(KerjaKuliah::class, 'name', 'nama_perusahaan', 'jabatan', 'tahun_kerja', 'nama_universitas', 'jurusan')->paginate(10);

        return view('livewire.tables.kerja-kuliah.index-kerja-kuliah', compact('dataKerjaKuliah'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'KerjaKuliah']);
    }
}
