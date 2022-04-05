<?php

namespace App\Http\Livewire\User\MencariKerja;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Container;
use App\Models\MencariKerja;
use App\Models\RequestEdit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMencariKerjaUser extends Component
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
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/mencarikerja', $name);
            }
            $data['dibuat'] = Auth::user()->name;
            $container = Container::create($data);

            RequestEdit::create([
                'id_container' => $container->id,
                'id_user'      => Auth::user()->id,
                'id_table'     => $this->selectedId,
                'table_type'   => 'mencarikerja',
            ]);

            RoleHelper::validate();
        });

        $this->resetForm();
        $this->emit('showAlert', 'success', "Permintaan berhasil diajukan.");

        return to_route('user.mencarikerja');
    }

    public function render()
    {
        return view('livewire.user.mencari-kerja.edit-mencari-kerja-user')->layout('guest');
    }
}
