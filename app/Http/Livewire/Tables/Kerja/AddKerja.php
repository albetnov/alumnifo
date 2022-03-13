<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Models\Kerja;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Rfc4122\UuidV4;

class AddKerja extends Component
{
    use WithFileUploads;
    public $name, $jenis_kelamin, $nama_perusahaan, $jabatan, $tahun_kerja, $gambar;

    protected $rules = [
        'name' => 'required',
        'jenis_kelamin' => 'required|in:l,p',
        'nama_perusahaan' => 'required',
        'jabatan' => 'required',
        'tahun_kerja' => 'required|numeric|min:2000|digits:4',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->name = "";
        $this->jenis_kelamin = "";
        $this->nama_perusahaan = "";
        $this->jabatan = "";
        $this->tahun_kerja = "2000";
        $this->gambar = null;
    }

    public function store()
    {
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time() . hash("sha256", $this->gambar->getClientOriginalName()) . $this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerja', $name);
                $data['gambar'] = $name;
            }
            Kerja::create($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e}");
            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");
    }

    public function render()
    {
        return view('livewire.tables.kerja.add')->layout('livewire.layouts.main', ['href' => 'Tables/Kerja', 'name' => 'Add']);
    }
}
