<?php

namespace App\Http\Livewire\Tables\Kuliah;

use App\Models\Kuliah;
use Illuminate\Support\Facades\Auth;
use Livewire\{Component, WithFileUploads};

class AddKuliah extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $nama_universitas;
    public $jurusan;
    public $gambar;

    protected $rules = [
        'name'            => 'required',
        'jenis_kelamin'   => 'required|in:l,p',
        'nama_universitas' => 'required',
        'jurusan'         => 'required',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->name = "";
        $this->jenis_kelamin = "";
        $this->nama_universitas = "";
        $this->jurusan = "";
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
                $this->gambar->storeAs('public/kuliah', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            Kuliah::create($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");
            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");
        return to_route('table.kuliah.index');
    }

    public function render()
    {
        return view('livewire.tables.kuliah.add-kuliah')->layout('livewire.layouts.main', ['href' => 'Tables/Kuliah', 'name' => 'Add']);
    }
}
