<?php

namespace App\Http\Livewire\Tables\MencariKerja;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\MencariKerja;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\{Auth, Hash, RateLimiter, Storage};
use Livewire\{Component, WithPagination};

class IndexMencariKerja extends Component
{
    use WithPagination, BaseTable;

    protected $paginationTheme = 'bootstrap';
    public $imgPreview = false;
    public $name;
    public $deleteOpened = false;
    public $selectedId;
    public $items = [];
    public $bulkAction = false;
    public $password;

    protected $rules = [
        'password' => 'required',
        'items' => 'numeric'
    ];

    public function updated($fields)
    {
        if ($fields == 'items') {
            $this->bulkAction = true;
        } else {
            $this->validateOnly($fields);
        }
        if ($this->items === []) {
            $this->bulkAction = false;
        }
    }

    public function enterSudo()
    {
        if (RateLimiter::remaining('password-confirmation', 3)) {
            RateLimiter::hit('password-confirmation');
        }
        if (RateLimiter::tooManyAttempts('password-confirmation', 3)) {
            $seconds = RateLimiter::availableIn('password-confirmation');

            return $this->emit('showAlert', 'error', 'Percobaan terlalu banyak. Akses ditolak selama: ' . $seconds);
        }
        if (!Hash::check($this->password, Auth::user()->password)) {
            return $this->emit('showAlert', 'error', 'Password salah!');
        }
        $this->emit('showAlert', 'success', 'Akses Sudo terbuka');
        try {
            foreach (MencariKerja::get() as $mencariKerja) {
                if ($mencariKerja->gambar) {
                    Storage::disk('public')->delete('mencari-kerja/' . $mencariKerja->gambar);
                }
                $mencariKerja->delete();
            }
        } catch (\Exception $e) {
            return $this->emit('showAlert', 'error', "Gagal menghapus data: {$e->getMessage()}");
        }
        return $this->emit('showAlert', 'success', 'Semua data dah hilang');
    }

    public function bulkDelete()
    {
        foreach ($this->items as $item) {
            try {
                $find = MencariKerja::where('id', $item)->first();
                if ($find->gambar) {
                    Storage::disk('public')->delete('mencari-kerja/' . $find->gambar);
                }
                $find->delete();
            } catch (\Exception $e) {
                $this->emit('showAlert', 'error', "Gagal menghapus data: {$e->getMessage()}");
                return;
                break;
            }
        }
        $this->items = [];
        $this->bulkAction = false;
        $this->emit('showAlert', 'success', 'Data berhasil dihapus.');
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
            $data = MencariKerja::where('id', $id)->firstOrFail();
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
            $data = MencariKerja::where('id', $id)->firstOrFail();
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
            $find = MencariKerja::find($this->selectedId)->firstOrFail();
            if ($find->gambar) {
                Storage::disk('public')->delete('mencari-kerja/' . $find->gambar);
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
        $dataMencariKerja = $this->baseRender(MencariKerja::class, 'name', 'jenis_kelamin', 'alamat','alasan_mencari_kerja','kontak')->paginate(10);
        return view('livewire.tables.mencari-kerja.index-mencari-kerja', compact('dataMencariKerja'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'MencariKerja']);
    }
}
