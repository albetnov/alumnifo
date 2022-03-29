<?php

namespace App\Http\Livewire\Tables\KerjaKuliah;

use App\Models\KerjaKuliah;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddKerjaKuliah extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $nama_universitas;
    public $jurusan;
    public $gambar;

    protected $rules = [
        'name'              => 'required',
        'jenis_kelamin'     => 'required|in:l,p',
        'nama_perusahaan'   => 'required',
        'jabatan'           => 'required',
        'tahun_kerja'       => 'required|numeric|min:2000|digits:4',
        'nama_universitas'  => 'required',
        'jurusan'           => 'required',
        'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
        $this->tahun_kerja = "";
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
                $name = time() . hash("sha256", $this->gambar->getClientOriginalName()) . $this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerjakuliah', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            KerjaKuliah::create($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return to_route('table.kerja-kuliah.index');
    }

    public function render()
    {
        return view('livewire.tables.kerja-kuliah.add-kerja-kuliah')->layout('livewire.layouts.main', ['href' => 'Tables/KerjaKuliah', 'name' => 'Add']);
    }
}
