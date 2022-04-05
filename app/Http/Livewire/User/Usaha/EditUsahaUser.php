<?php

namespace App\Http\Livewire\User\Usaha;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Container;
use App\Models\RequestEdit;
use App\Models\Usaha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUsahaUser extends Component
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
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/usaha', $name);
            }
            $data['dibuat'] = Auth::user()->name;
            $container = Container::create($data);

            RequestEdit::create([
                'id_container' => $container->id,
                'id_user'      => Auth::user()->id,
                'id_table'     => $this->selectedId,
                'table_type'   => 'usaha',
            ]);

            RoleHelper::validate();
        });

        $this->resetForm();
        $this->emit('showAlert', 'success', "Permintaan berhasil diajukan.");

        return to_route('user.usaha');
    }

    public function render()
    {
        return view('livewire.user.usaha.edit-usaha-user')->layout('guest');
    }
}
