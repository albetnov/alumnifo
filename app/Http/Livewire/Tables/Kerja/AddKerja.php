<?php

namespace App\Http\Livewire\Tables\Kerja;

use Livewire\Component;
use Livewire\WithFileUploads;

class AddKerja extends Component
{
    use WithFileUploads;
    public $nama, $jenis_kelamin, $nama_perusahaan, $jabatan, $tahun_kerja, $gambar;

    protected $rules = [
        'nama' => 'required',
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

    public function store()
    {
        $data = $this->validate();
        dd($data);
    }

    public function render()
    {
        return view('livewire.tables.kerja.add')->layout('livewire.layouts.main', ['href' => 'Tables/Kerja', 'name' => 'Add']);
    }
}
