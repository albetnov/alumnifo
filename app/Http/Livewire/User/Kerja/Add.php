<?php

namespace App\Http\Livewire\User\Kerja;

use Livewire\Component;

class Add extends Component
{
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $gambar;

    public function render()
    {
        return view('livewire.user.kerja.add')->layout('guest');
    }
}
