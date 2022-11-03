<?php

namespace App\Http\Livewire\Request;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\Kerja;
use App\Models\KerjaKuliah;
use App\Models\Kuliah;
use App\Models\MencariKerja;
use App\Models\Request;
use App\Models\Usaha;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class RequestIndex extends Component
{
    use WithPagination;
    use BaseTable;
    use BulkDelete;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $deleteOpened = false;
    public $selectedId;
    public $status;
    public $detailsOpened = false;
    public $tableType;
    public $modelQuery;

    public function mount()
    {
        $this->setModel(Request::class);
    }

    public function updated($fields)
    {
        $this->updatedBulk($fields);
        $this->updatedBase($fields);
    }

    public function cleanUp()
    {
        $this->modelQuery = "";
        $this->name = "";
        $this->deleteOpened = false;
        $this->detailsOpened = false;
        $this->selectedId = "";
        $this->tableType = "";
    }

    public function openDelete($id)
    {
        try {
            $data = Request::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return;
        }
        $this->deleteOpened = true;
        $this->name = $data->table_type;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function deleteData()
    {
        try {
            $find = Request::find($this->selectedId);
            $query = $this->findTables($find->id);
            if ($query->gambar) {
                Storage::disk('public')->delete($this->tableType.'/'.$query->gambar);
            }
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

    private function findTables($id)
    {
        try {
            $query = Kerja::where('id_request', $id)->first();
            $this->tableType = "kerja";
        } catch (ModelNotFoundException $e) {
            $query = KerjaKuliah::where('id_request', $id)->first();
            $this->tableType = "kerjakuliah";
        } catch (ModelNotFoundException $e) {
            $query = Kuliah::where('id_request', $id)->first();
            $this->tableType = "kuliah";
        } catch (ModelNotFoundException $e) {
            $query = MencariKerja::where('id_request', $id)->first();
            $this->tableType = "mencarikerja";
        } catch (ModelNotFoundException $e) {
            $query = Usaha::where('id_request', $id)->first();
            $this->tableType = "usaha";
        }

        return $query;
    }

    public function openDetails($id)
    {
        $this->cleanUp();

        $query = $this->findTables($id);

        $this->detailsOpened = true;
        $this->modelQuery = $query;

        $this->emit('openModal', 'detailsPreview');
    }

    public function approve($id)
    {
        $query = Request::find($id);
        $user = User::find($query->user_id);
        if (!$user->hasPermissionTo('participate')) {
            $user->givePermissionTo('participate');
        }

        if ($query->status !== 'pending') {
            $this->emit('showAlert', 'error', 'Data sudah di proses');

            return;
        }

        $query->update([
            'status'     => 'accepted',
            'handled_by' => Auth::user()->name,
        ]);

        $this->emit('showAlert', 'success', 'Data berhasil di ijinkan');
    }

    public function decline($id)
    {
        $query = Request::find($id);
        $user = User::find($query->user_id);
        if (!$user->hasPermissionTo('participate')) {
            $user->givePermissionTo('participate');
        }

        if ($query->status !== 'pending') {
            $this->emit('showAlert', 'error', 'Data sudah di proses');

            return;
        }

        $query->update([
            'status'     => 'rejected',
            'handled_by' => Auth::user()->name,
        ]);

        $this->emit('showAlert', 'success', 'Data berhasil di tolak');
    }

    public function render()
    {
        $requests = $this->baseRender(Request::class);
        if ($this->status == 'accepted') {
            $requests = $requests->where('status', 'accepted')->paginate(10);
        } elseif ($this->status == 'rejected') {
            $requests = $requests->where('status', 'rejected')->paginate(10);
        } else {
            $requests = $requests->where('status', 'pending')->paginate(10);
        }

        return view('livewire.request.request-index', compact('requests'))->layout('livewire.layouts.main', ['href' => 'Request', 'name' => 'Add Data Request List']);
    }
}
