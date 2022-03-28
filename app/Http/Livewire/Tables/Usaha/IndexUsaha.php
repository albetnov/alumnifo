<?php

namespace App\Http\Livewire\Tables\Usaha;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Usaha;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUsaha extends Component
{
    use WithPagination;
    use BaseTable;

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
        'items'    => 'numeric',
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

            return $this->emit('showAlert', 'error', 'Percobaan terlalu banyak. Akses ditolak selama: '.$seconds);
        }
        if (!Hash::check($this->password, Auth::user()->password)) {
            return $this->emit('showAlert', 'error', 'Password salah!');
        }
        $this->emit('showAlert', 'success', 'Akses Sudo terbuka');

        try {
            foreach (Usaha::get() as $usaha) {
                if ($usaha->gambar) {
                    Storage::disk('public')->delete('usaha/'.$usaha->gambar);
                }
                $usaha->delete();
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
                $find = Usaha::where('id', $item)->first();
                if ($find->gambar) {
                    Storage::disk('public')->delete('usaha/'.$find->gambar);
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
            $data = Usaha::where('id', $id)->firstOrFail();
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
            $data = Usaha::where('id', $id)->firstOrFail();
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
            $find = Usaha::find($this->selectedId)->firstOrFail();
            if ($find->gambar) {
                Storage::disk('public')->delete('usaha/'.$find->gambar);
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
        $dataUsaha = $this->baseRender(Usaha::class, 'name', 'jenis_usaha', 'alamat_usaha')->paginate(10);

        return view('livewire.tables.usaha.index-usaha', compact('dataUsaha'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Usaha']);
    }
}
