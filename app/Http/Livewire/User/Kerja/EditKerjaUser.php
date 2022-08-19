<?php

namespace App\Http\Livewire\User\Kerja;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Container;
use App\Models\Kerja;
use App\Models\RequestEdit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKerjaUser extends Component
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
        if (!$this->gambarUpdated) {
            $this->gambar = null;
        }
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time() . hash("sha256", $this->gambar->getClientOriginalName()) . $this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerja', $name);
            }
            $data['dibuat'] = Auth::user()->name;
            $container = Container::create($data);

            RequestEdit::create([
                'id_container' => $container->id,
                'id_user'      => Auth::user()->id,
                'id_table'     => $this->selectedId,
                'table_type'   => 'kerja',
            ]);

            RoleHelper::validate();
        });

        $this->resetForm();
        $this->emit('showAlert', 'success', "Permintaan berhasil diajukan.");

        return to_route('user.kerja');
    }

    public function render()
    {
        return view('livewire.user.kerja.edit-kerja-user')->layout('guest');
    }
}
