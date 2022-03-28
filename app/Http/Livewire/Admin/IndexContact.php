<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\PublicContact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContact extends Component
{
    use WithPagination;
    use BaseTable;

    protected $paginationTheme = 'bootstrap';
    public $messagePreview = false;
    public $name;
    public $deleteOpened = false;
    public $selectedId;
    public $items = [];
    public $bulkAction = false;
    public $password;
    public $email;
    public $message;

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
            PublicContact::truncate();
        } catch (\Exception $e) {
            return $this->emit('showAlert', 'error', "Gagal menghapus data: {$e->getMessage()}");
        }

        return $this->emit('showAlert', 'success', 'Semua data dah hilang');
    }

    public function bulkDelete()
    {
        foreach ($this->items as $item) {
            try {
                $find = PublicContact::where('id', $item)->first();
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
        if ($this->messagePreview) {
            $this->messagePreview = false;
            $this->email = "";
            $this->message = "";
        }
        if ($this->deleteOpened) {
            $this->selectedId = "";
        }
        $this->name = "";
    }

    public function openDelete($id)
    {
        $this->cleanup();

        try {
            $data = PublicContact::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Data tidak ditemukan');

            return;
        }
        $this->deleteOpened = true;
        $this->name = $data->name;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function openMessage($id)
    {
        $this->cleanup();

        try {
            $data = PublicContact::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Data tidak ditemukan');

            return;
        }
        $this->messagePreview = true;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->message = $data->message;
        $this->emit('openModal', 'messagePreview');
    }

    public function deleteData()
    {
        try {
            $find = PublicContact::where('id', $this->selectedId)->firstOrFail();
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
        $contacts = $this->baseRender(PublicContact::class)->paginate(10);

        return view('livewire.admin.index-contact', compact('contacts'))->layout('livewire.layouts.main', ['href' => 'Manage Users', 'name' => 'Contact']);
    }
}
