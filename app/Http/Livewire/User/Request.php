<?php

namespace App\Http\Livewire\User;

use App\Models\Container;
use App\Models\Kerja;
use App\Models\KerjaKuliah;
use App\Models\Kuliah;
use App\Models\MencariKerja;
use App\Models\Request as ModelsRequest;
use App\Models\RequestEdit;
use App\Models\Usaha;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Request extends Component
{
    public $data;
    public $selectedId;
    public $action;
    public $tableType;
    public $allAdd;
    public $addEdit;

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

    public function cancel()
    {
        abort_if(!$this->data, 404);
        if ($this->action == 'add') {
            DB::transaction(function () {
                $query = $this->findTables($this->selectedId);
                if ($query->gambar) {
                    Storage::disk('public')->delete($this->tableType.'/'.$query->gambar);
                }
                $query->delete();
                ModelsRequest::find($this->selectedId)->delete();
            });
        } else {
            DB::transaction(function () {
                $container = Container::where('id', $this->data->id_container)->first();
                if ($container->gambar) {
                    Storage::disk('public')->delete($this->data->table_type.'/'.$container->gambar);
                }
                $container->delete();
                $this->data->delete();
            });
        }

        $this->data = null;
        $user = Auth::user();
        if (!$user->hasPermissionTo('participate')) {
            $user->givePermissionTo('participate');
        }

        $this->emit('showAlert', 'success', 'Data berhasil dihapus');
    }

    public function mount()
    {
        $add = ModelsRequest::where('user_id', Auth::user()->id)->where('status', 'pending')->first();
        $edit = RequestEdit::with('container')->where('id_user', Auth::user()->id)->where('status', 'pending')->first();

        if ($add) {
            $this->data = $add;
            $this->action = 'add';
            $this->selectedId = $add->id;
        } elseif ($edit) {
            $this->data = $edit;
            $this->action = 'edit';
            $this->selectedId = $edit->id;
        } else {
            $this->data = null;
        }

        $allAdd = ModelsRequest::where('user_id', Auth::user()->id)->where('status', '!=', 'pending')->get();
        $allEdit = RequestEdit::with('container')->where('id_user', Auth::user()->id)->where('status', '!=', 'pending')->get();
        $this->allAdd = $allAdd->isEmpty() ? null : $allAdd;
        $this->allEdit = $allEdit->isEmpty() ? null : $allEdit;
    }

    public function render()
    {
        return view('livewire.user.request')->layout('guest');
    }
}
