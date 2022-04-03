<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUsers extends Component
{
    use WithPagination;
    use BaseTable;
    use BulkDelete;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $deleteOpened = false;
    public $selectedId;

    public function mount()
    {
        $this->setModel(User::class);
    }

    public function updated($fields)
    {
        $this->updatedBulk($fields);
        $this->updatedBase($fields);
    }

    public function cleanUp()
    {
        $this->name = "";
        $this->deleteOpened = false;
        $this->selectedId = "";
    }

    public function openDelete($id)
    {
        try {
            $data = User::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return;
        }
        $this->deleteOpened = true;
        $this->name = $data->name;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function deleteData()
    {
        try {
            $find = User::find($this->selectedId);
            $find->delete();
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. ' . $q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: ' . $e->getMessage());

            return;
        }
        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function upLevel($id)
    {
        try {
            $find = User::find($id);
            $find->removeRole('disabled');
            $find->assignRole('user');
            $find->givePermissionTo('participate');
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menaikkan level. ' . $q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menaikkan level: ' . $e->getMessage());

            return;
        }

        $this->emit('showAlert', 'success', 'Level berhasil di naikkan');
    }

    public function render()
    {
        $users = $this->baseRender(User::class)->paginate(10);

        return view('livewire.users.index-users', compact('users'))->layout('livewire.layouts.main', ['href' => 'Users', 'name' => 'Users List']);
    }
}
