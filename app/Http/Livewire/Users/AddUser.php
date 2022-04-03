<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $conpass;
    public $roles;
    public $role;

    public function mount()
    {
        $this->roles = Role::get();
    }

    protected function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|unique:users,id,'.Auth::user()->id,
            'password' => 'required|min:8',
            'conpass'  => 'required_with:password|same:password',
            'role'     => 'required|exists:roles,id',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->conpass = "";
        $this->role = "";
    }

    public function store()
    {
        $data = $this->validate();

        try {
            $data['password'] = bcrypt($this->password);
            unset($data['conpass']);
            unset($data['role']);
            $user = User::create($data);
            $user->assignRole($this->role);
            if ($this->role == '3') {
                $user->givePermissionTo('participate');
            }
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return to_route('admin.users');
    }

    public function render()
    {
        return view('livewire.users.add-user')->layout('livewire.layouts.main', ['href' => 'Users', 'name' => 'Add']);
    }
}
