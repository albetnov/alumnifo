<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Models\Kerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKerja extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $gambar;
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(Kerja $kerja)
    {
        $this->name = $kerja->name;
        $this->jenis_kelamin = $kerja->jenis_kelamin;
        $this->nama_perusahaan = $kerja->nama_perusahaan;
        $this->jabatan = $kerja->jabatan;
        $this->tahun_kerja = $kerja->tahun_kerja;
        $this->gambar = $kerja->gambar;
        $this->selectedId = $kerja->id;
    }

    protected $rules = [
        'name'            => 'required',
        'jenis_kelamin'   => 'required|in:l,p',
        'nama_perusahaan' => 'required',
        'jabatan'         => 'required',
        'tahun_kerja'     => 'required|numeric|min:2000|digits:4',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
        $this->tahun_kerja = "2000";
        $this->gambar = null;
        $this->gambarUpdated = false;
    }

    public function update()
    {
        $currentData = Kerja::where('id', $this->selectedId)->firstOrFail();
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                if ($currentData->gambar) {
                    Storage::disk('public')->delete('kerja/'.$currentData->gambar);
                }
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerja', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            $currentData->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();
        $this->emit('showAlert', 'success', "Data berhasil di perbarui.", '/table/kerja');
    }

    public function render()
    {
        return view('livewire.tables.kerja.edit-kerja')->layout('livewire.layouts.main', ['href' => 'Tables/Kerja', 'name' => 'Edit']);
    }
}
