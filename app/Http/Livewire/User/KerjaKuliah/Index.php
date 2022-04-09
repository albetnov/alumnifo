<?php

namespace App\Http\Livewire\User\KerjaKuliah;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\KerjaKuliah;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use BaseTable;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filterUsingYear();
    }

    public function updated($fields)
    {
        $this->updatedBase($fields);
    }

    public function render()
    {
        $kerjaKuliah = $this->baseRender(KerjaKuliah::class)->cleanRequest()->paginate(10);

        return view('livewire.user.kerja-kuliah.index', compact('kerjaKuliah'))->layout('guest');
    }
}
