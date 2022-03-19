<?php

namespace App\Http\Livewire\Tables\Usaha;

use App\Models\Usaha;
use Illuminate\Support\Facades\{Auth, Storage};
use Livewire\{Component, WithFileUploads};

class EditUsaha extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $jenis_usaha;
    public $alamat_usaha;
    public $tahun_usaha;
    public $gambar;
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(Usaha $usaha)
    {
        $this->name = $usaha->name;
        $this->jenis_kelamin = $usaha->jenis_kelamin;
        $this->jenis_usaha = $usaha->jenis_usaha;
        $this->alamat_usaha = $usaha->alamat_usaha;
        $this->tahun_usaha = $usaha->tahun_usaha;
        $this->gambar = $usaha->gambar;
        $this->selectedId = $usaha->id;
    }

    protected $rules = [
        'name'            => 'required',
        'jenis_kelamin'   => 'required|in:l,p',
        'jenis_usaha'     => 'required',
        'alamat_usaha'    => 'required',
        'tahun_usaha'     => 'required|numeric|min:2000|digits:4',
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
        $this->jenis_usaha = "";
        $this->alamat_usaha = "";
        $this->tahun_usaha = "";
        $this->gambar = null;
        $this->gambarUpdated = false;
    }

    public function update()
    {
        $currentData = Usaha::where('id', $this->selectedId)->firstOrFail();
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                if ($currentData->gambar) {
                    Storage::disk('public')->delete('usaha/'.$currentData->gambar);
                }
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/usaha', $name);
                $data['gambar'] = $name;
            }
            $data['dibuat'] = Auth::user()->name;
            $currentData->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();
        $this->emit('showAlert', 'success', "Data berhasil di perbarui.", '/table/usaha');
    }

    public function render()
    {
        return view('livewire.tables.usaha.edit-usaha')->layout('livewire.layouts.main', ['href' => 'Tables/Usaha', 'name' => 'Edit']);
    }
}
