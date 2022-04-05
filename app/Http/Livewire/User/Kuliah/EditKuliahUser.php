<?php

namespace App\Http\Livewire\User\Kuliah;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Container;
use App\Models\Kuliah;
use App\Models\RequestEdit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKuliahUser extends Component
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
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time() . hash("sha256", $this->gambar->getClientOriginalName()) . $this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kuliah', $name);
            }
            $data['dibuat'] = Auth::user()->name;
            $container = Container::create($data);

            RequestEdit::create([
                'id_container' => $container->id,
                'id_user'      => Auth::user()->id,
                'id_table'     => $this->selectedId,
                'table_type'   => 'kuliah',
            ]);

            RoleHelper::validate();
        });

        $this->resetForm();
        $this->emit('showAlert', 'success', "Permintaan berhasil diajukan.");

        return to_route('user.kuliah');
    }

    public function render()
    {
        return view('livewire.user.kuliah.edit-kuliah-user')->layout('guest');
    }
}
