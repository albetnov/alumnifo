<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $conpass;
    public $selectedId;
    public $roles;
    public $role;

    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedId = $user->id;
        $this->roles = Role::get();
        $this->role = Role::where('name', $user->getRoleNames()->get(0))->first()->id;
    }

    protected function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|unique:users,id,'.Auth::user()->id,
            'password' => 'nullable|min:8',
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
    }

    public function update()
    {
        $data = $this->validate();

        try {
            $data['password'] = bcrypt($this->password);
            unset($data['conpass']);
            unset($data['role']);
            $user = User::where('id', $this->selectedId)->firstOrFail();
            $user->removeRole($user->getRoleNames()->get(0));
            $user->assignRole($this->role);
            if ($this->role == '3' && !$user->hasPermissionTo('participate')) {
                $user->givePermissionTo('participate');
            }
            $user->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di perbarui.");

        return to_route('admin.users');
    }

    public function render()
    {
        return view('livewire.users.edit-user')->layout('livewire.layouts.main', ['href' => 'Users', 'name' => 'Add']);
    }
}
