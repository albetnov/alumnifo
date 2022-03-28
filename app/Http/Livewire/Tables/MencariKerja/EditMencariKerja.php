<?php

namespace App\Http\Livewire\Tables\MencariKerja;

use App\Models\MencariKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMencariKerja extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $alamat;
    public $alasan_mencari_kerja;
    public $kontak;
    public $gambar;
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(MencariKerja $mencariKerja)
    {
        $this->name = $mencariKerja->name;
        $this->jenis_kelamin = $mencariKerja->jenis_kelamin;
        $this->alamat = $mencariKerja->alamat;
        $this->alasan_mencari_kerja = $mencariKerja->alasan_mencari_kerja;
        $this->kontak = $mencariKerja->kontak;
        $this->gambar = $mencariKerja->gambar;
        $this->selectedId = $mencariKerja->id;
    }

    protected $rules = [
        'name'                  => 'required',
        'jenis_kelamin'         => 'required|in:l,p',
        'alamat'                => 'required',
        'alasan_mencari_kerja'  => 'required',
        'kontak'                => 'required',
        'gambar'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
        $this->alamat = "";
        $this->alasan_mencari_kerja = "";
        $this->kontak = "";
        $this->gambar = null;
        $this->gambarUpdated = false;
    }

    public function update()
    {
        $currentData = MencariKerja::where('id', $this->selectedId)->firstOrFail();
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                if ($currentData->gambar) {
                    Storage::disk('public')->delete('mencari-kerja/'.$currentData->gambar);
                }
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/mencari-kerja', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            $currentData->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();
        $this->emit('showAlert', 'success', "Data berhasil di perbarui.", '/table/mencari-kerja');
    }

    public function render()
    {
        return view('livewire.tables.mencari-kerja.edit-mencari-kerja')->layout('livewire.layouts.main', ['href' => 'Tables/MencariKerja', 'name' => 'Edit']);
    }
}
