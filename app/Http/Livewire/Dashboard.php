<?php

namespace App\Http\Livewire;

use App\Models\Kerja;
use App\Models\KerjaKuliah;
use App\Models\Kuliah;
use App\Models\MencariKerja;
use App\Models\Request;
use App\Models\RequestEdit;
use App\Models\Usaha;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'user' => User::count(),
            'kerja' => Kerja::count(),
            'kerja_kuliah' => KerjaKuliah::count(),
            'kuliah' => Kuliah::count(),
            'mencari_kerja' => MencariKerja::count(),
            'membuka_usaha' => Usaha::count(),
            'requestCount' => Request::count(),
            'requestEditCount' => RequestEdit::count(),
        ];

        return view('livewire.admin.dashboard', $data)->layout('livewire.layouts.main', ['href' => 'Main', 'name' => 'Dashboard']);
    }
}
