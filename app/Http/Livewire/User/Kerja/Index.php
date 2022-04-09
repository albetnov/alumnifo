<?php

namespace App\Http\Livewire\User\Kerja;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Kerja;
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
        $kerjas = $this->baseRender(Kerja::class)->cleanRequest()->paginate(10);

        return view('livewire.user.kerja.index', compact('kerjas'))->layout('guest');
    }
}
