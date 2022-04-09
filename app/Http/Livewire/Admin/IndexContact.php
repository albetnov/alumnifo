<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\PublicContact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContact extends Component
{
    use WithPagination;
    use BaseTable;
    use BulkDelete;

    protected $paginationTheme = 'bootstrap';
    public $messagePreview = false;
    public $name;
    public $deleteOpened = false;
    public $selectedId;
    public $email;
    public $message;

    public function mount()
    {
        $this->setModel(PublicContact::class);
    }

    public function updated($fields)
    {
        $this->updatedBulk($fields);
        $this->updatedBase($fields);
    }

    private function cleanup()
    {
        if ($this->messagePreview) {
            $this->messagePreview = false;
            $this->email = "";
            $this->message = "";
        }
        if ($this->deleteOpened) {
            $this->selectedId = "";
        }
        $this->name = "";
    }

    public function openDelete($id)
    {
        $this->cleanup();

        try {
            $data = PublicContact::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Data tidak ditemukan');

            return;
        }
        $this->deleteOpened = true;
        $this->name = $data->name;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function openMessage($id)
    {
        $this->cleanup();

        try {
            $data = PublicContact::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Data tidak ditemukan');

            return;
        }
        $this->messagePreview = true;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->message = $data->message;
        $this->emit('openModal', 'messagePreview');
    }

    public function deleteData()
    {
        try {
            $find = PublicContact::where('id', $this->selectedId)->firstOrFail();
            $find->delete();
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. '.$q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: '.$e->getMessage());

            return;
        }
        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function render()
    {
        $contacts = $this->baseRender(PublicContact::class)->paginate(10);

        return view('livewire.admin.index-contact', compact('contacts'))->layout('livewire.layouts.main', ['href' => 'Manage Users', 'name' => 'Contact']);
    }
}
