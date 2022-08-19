<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'SuperAdmin']);
        $permission = Permission::find(1)->get();
        $role->givePermissionTo($permission);
        $role->givePermissionTo('chatting');
        Role::create(['name' => 'disabled']);
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('edit profile');
        $user->givePermissionTo('chatting');
    }
}
