<?php

namespace App\Http\Livewire\Tables\KerjaKuliah;

use App\Models\KerjaKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKerjaKuliah extends Component
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
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(KerjaKuliah $kerjaKuliah)
    {
        $this->name = $kerjaKuliah->name;
        $this->jenis_kelamin = $kerjaKuliah->jenis_kelamin;
        $this->nama_perusahaan = $kerjaKuliah->nama_perusahaan;
        $this->jabatan = $kerjaKuliah->jabatan;
        $this->tahun_kerja = $kerjaKuliah->tahun_kerja;
        $this->nama_universitas = $kerjaKuliah->nama_universitas;
        $this->jurusan = $kerjaKuliah->jurusan;
        $this->gambar = $kerjaKuliah->gambar;
        $this->selectedId = $kerjaKuliah->id;
    }

    protected $rules = [
        'name'             => 'required',
        'jenis_kelamin'    => 'required|in:l,p',
        'nama_perusahaan'  => 'required',
        'jabatan'          => 'required',
        'tahun_kerja'      => 'required|numeric|min:2000|digits:4',
        'nama_universitas' => 'required',
        'jurusan'          => 'required',
        'gambar'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedGambar()
    {
        $this->gambarUpdated = true;
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
        $this->gambarUpdated = false;
    }

    public function update()
    {
        $currentData = KerjaKuliah::where('id', $this->selectedId)->firstOrFail();
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                if ($currentData->gambar) {
                    Storage::disk('public')->delete('kerjakuliah/'.$currentData->gambar);
                }
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerjakuliah', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            $currentData->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();
        $this->emit('showAlert', 'success', "Data berhasil di perbarui.", '/table/kerja-kuliah');
    }

    public function render()
    {
        return view('livewire.tables.kerja-kuliah.edit-kerja-kuliah')->layout('livewire.layouts.main', ['href' => 'Tables/KerjaKuliah', 'name' => 'Edit']);
    }
}
