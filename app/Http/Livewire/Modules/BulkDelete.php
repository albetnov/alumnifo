<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

trait BulkDelete
{
    public $model;
    public $items = [];
    public $bulkAction = false;
    public $hasPhoto = false;
    public $password;
    public $fieldName = "gambar";
    public $pathName;

    protected $rules = [
        'password' => 'required',
        'items'    => 'numeric',
    ];

    public function updatedBulk($fields)
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
            if ($this->hasPhoto) {
                foreach ($this->model::get() as $fetch) {
                    $fieldName = $this->fieldName;
                    if ($fetch->$fieldName) {
                        Storage::disk('public')->delete("{$this->pathName}/".$fetch->gambar);
                    }
                    $fetch->delete();
                }
            } else {
                $this->model::truncate();
            }
            $this->emit('showAlert', 'success', 'Semua data dah hilang');
        } catch (\Exception $e) {
            return $this->emit('showAlert', 'error', "Gagal menghapus data: {$e->getMessage()}");
        }
        if ($this->model == User::class) {
            return Auth::logout();
        }
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function hasPhoto($boolean, $pathName, $fieldName = "gambar")
    {
        if (!is_bool($boolean)) {
            throw new \InvalidArgumentException("Must boolean");
        }
        $this->hasPhoto = $boolean;
        if ($fieldName != "gambar") {
            $this->fieldName = $fieldName;
        }
        $this->pathName = $pathName;
    }

    public function bulkDelete()
    {
        foreach ($this->items as $item) {
            try {
                $find = $this->model::where('id', $item)->first();
                if ($this->hasPhoto) {
                    $fieldName = $this->fieldName;
                    if ($find->$fieldName) {
                        Storage::disk('public')->delete("{$this->pathName}/".$find->gambar);
                    }
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
}
