<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Modules\BaseTable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class IndexUsers extends Component
{
    use WithPagination;
    use BaseTable;

    protected $paginationTheme = 'bootstrap';
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
            User::truncate();
        } catch (\Exception $e) {
            return $this->emit('showAlert', 'error', "Gagal menghapus data: {$e->getMessage()}");
        }
        return $this->emit('showAlert', 'success', 'Semua data dah hilang');
    }

    public function bulkDelete()
    {
        foreach ($this->items as $item) {
            try {
                $find = User::where('id', $item)->first();
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
        if ($this->deleteOpened) {
            $this->name = "";
            $this->selectedId = "";
        }
    }

    public function openDelete($id)
    {
        $this->cleanup();

        try {
            $data = User::where('id', $id)->firstOrFail();
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
            $find = User::find($this->selectedId)->firstOrFail();
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

    public function upLevel($id)
    {
        try {
            $find = User::find($id);
            $find->removeRole('disabled');
            $find->assignRole('user');
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menaikkan level. ' . $q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menaikkan level: ' . $e->getMessage());

            return;
        }

        $this->emit('showAlert', 'success', 'Level berhasil di naikkan');
    }

    public function render()
    {
        $users = $this->baseRender(User::class)->paginate(10);

        return view('livewire.users.index-users', compact('users'))->layout('livewire.layouts.main', ['href' => 'Users', 'name' => 'Users List']);
    }
}
