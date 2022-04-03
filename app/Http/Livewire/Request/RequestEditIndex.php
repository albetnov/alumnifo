<?php

namespace App\Http\Livewire\Request;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\Container;
use App\Models\Kerja;
use App\Models\RequestEdit;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RequestEditIndex extends Component
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
        $this->setModel(RequestEdit::class);
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
            $data = RequestEdit::where('id', $id)->firstOrFail();
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
            DB::transaction(function () {
                $find = RequestEdit::find($this->selectedId);
                if ($find->id_container) {
                    Container::find($find->id_container)->delete();
                }
                $find->delete();
            });
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. '.$q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: '.$e->getMessage());

            return;
        }
        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function openDetails($id)
    {
        $this->cleanUp();

        $find = RequestEdit::find($id);
        $this->tableType = strtolower($find->table_type);
        $modelQuery = Container::find($find->id);

        $this->detailsOpened = true;
        $this->modelQuery = $modelQuery;

        $this->emit('openModal', 'detailsPreview');
    }

    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $query = RequestEdit::find($id);
            if ($query->status != 'pending') {
                return $this->emit('showAlert', 'error', 'Data sudah di proses');
            }
            $user = User::find($query->id_user);
            if (!$user->hasPermissionTo('participate')) {
                $user->givePermissionTo('participate');
            }
            $container = Container::find($query->id_container);

            $data = [
                'name'            => $container->name,
                'nama_perusahaan' => $container->nama_perusahaan,
                'jabatan'         => $container->jabatan,
                'tahun_kerja'     => $container->tahun_kerja,
            ];
            if ($container->gambar) {
                $data['gambar'] = $container->gambar;
            }
            Kerja::find($query->id_table)->update($data);

            $query->update([
                'id_container' => null,
                'status'       => 'accepted',
                'handled_by'   => Auth::user()->name,
            ]);

            $container->delete();
        });

        return $this->emit('showAlert', 'success', 'Data berhasil di ijinkan');
    }

    public function decline($id)
    {
        DB::transaction(function () use ($id) {
            $query = RequestEdit::find($id);
            if ($query->status != 'pending') {
                return $this->emit('showAlert', 'error', 'Data sudah di proses');
            }
            $user = User::find($query->id_user);
            if (!$user->hasPermissionTo('participate')) {
                $user->givePermissionTo('participate');
            }

            $container = Container::find($query->id_container)->delete();

            $query->update([
                'id_container' => null,
                'status'       => 'rejected',
                'handled_by'   => Auth::user()->name,
            ]);

            $container->delete();
        });

        return $this->emit('showAlert', 'success', 'Data berhasil di tolak');
    }

    public function render()
    {
        $requests = $this->baseRender(RequestEdit::class);
        if ($this->status == 'accepted') {
            $requests = $requests->where('status', 'accepted')->paginate(10);
        } elseif ($this->status == 'rejected') {
            $requests = $requests->where('status', 'rejected')->paginate(10);
        } else {
            $requests = $requests->where('status', 'pending')->paginate(10);
        }

        return view('livewire.request.request-edit-index', compact('requests'))->layout('livewire.layouts.main', ['href' => 'Request', 'name' => 'Add Data Request List']);
    }
}
