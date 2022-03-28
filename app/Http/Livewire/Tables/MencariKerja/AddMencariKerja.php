<?php

namespace App\Http\Livewire\Tables\MencariKerja;

use App\Models\MencariKerja;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddMencariKerja extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $alamat;
    public $alasan_mencari_kerja;
    public $kontak;
    public $gambar;

    protected $rules = [
        'name'                    => 'required',
        'jenis_kelamin'           => 'required|in:l,p',
        'alamat'                  => 'required',
        'alasan_mencari_kerja'    => 'required',
        'kontak'                  => 'required',
        'gambar'                  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->name = "";
        $this->jenis_kelamin = "";
        $this->jenis_usaha = "";
        $this->alasan_mencari_kerja = "";
        $this->kontak = "";
        $this->gambar = null;
    }

    public function store()
    {
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/mencari-kerja', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            MencariKerja::create($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return to_route('table.mencari-kerja.index');
    }

    public function render()
    {
        return view('livewire.tables.mencari-kerja.add-mencari-kerja')->layout('livewire.layouts.main', ['href' => 'Tables/MencariKerja', 'name' => 'Add']);
    }
}
