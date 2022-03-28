<?php

namespace App\Http\Livewire\Tables\Kuliah;

use App\Models\Kuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKuliah extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $nama_universitas;
    public $jurusan;
    public $gambar;
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(Kuliah $kuliah)
    {
        $this->name = $kuliah->name;
        $this->jenis_kelamin = $kuliah->jenis_kelamin;
        $this->nama_universitas = $kuliah->nama_universitas;
        $this->jurusan = $kuliah->jurusan;
        $this->gambar = $kuliah->gambar;
        $this->selectedId = $kuliah->id;
    }

    protected $rules = [
        'name'             => 'required',
        'jenis_kelamin'    => 'required|in:l,p',
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
        $this->nama_universitas = "";
        $this->jurusan = "";
        $this->gambar = null;
        $this->gambarUpdated = false;
    }

    public function update()
    {
        $currentData = Kuliah::where('id', $this->selectedId)->firstOrFail();
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                if ($currentData->gambar) {
                    Storage::disk('public')->delete('kuliah/'.$currentData->gambar);
                }
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kuliah', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            $currentData->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();
        $this->emit('showAlert', 'success', "Data berhasil di perbarui.", '/table/kuliah');
    }

    public function render()
    {
        return view('livewire.tables.kuliah.edit-kuliah')->layout('livewire.layouts.main', ['href' => 'Tables/Kuliah', 'name' => 'Edit']);
    }
}
