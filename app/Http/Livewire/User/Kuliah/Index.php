<?php

namespace App\Http\Livewire\User\Kuliah;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Kuliah;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use BaseTable;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function updated($fields)
    {
        $this->updatedBase($fields);
    }

    public function render()
    {
        $collages = $this->baseRender(Kuliah::class)->paginate(10);

        return view('livewire.user.kuliah.index', compact('collages'))->layout('guest');
    }
}
