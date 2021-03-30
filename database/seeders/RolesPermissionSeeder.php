<?php

namespace Database\Seeders;

//Roles and Permission Class Import
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        // create roles and assign existing permissions
        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo('edit');
        $moderator->givePermissionTo('delete');

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role2 = Role::create(['name' => 'developer']);

    }
}
