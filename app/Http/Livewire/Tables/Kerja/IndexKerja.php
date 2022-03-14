<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Kerja;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class IndexKerja extends Component
{
    use WithPagination, BaseTable;

    protected $paginationTheme = 'bootstrap';
    public $imgPreview = false, $name, $deleteOpened = false, $selectedId;

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
            $data = Kerja::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
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
            $data = Kerja::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
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

            $find = Kerja::find($this->selectedId)->firstOrFail();
            if ($find->gambar) {
                Storage::disk('public')->delete('kerja/' . $find->gambar);
            }
            $find->delete();
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. ' . $q->getMessage());
            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: ' . $e->getMessage());
            return;
        }
        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function render()
    {
        $kerjas = $this->baseRender(Kerja::class, 'name', 'nama_perusahaan', 'jabatan', 'tahun_kerja')->paginate(10);
        return view('livewire.tables.kerja.index', compact('kerjas'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Kerja']);
    }
}
