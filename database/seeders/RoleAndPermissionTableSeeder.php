<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Role, Permission};

class RoleAndPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleVerifikator = Role::create(['name' => 'Verifikator']);
        $roleAdminOPD = Role::create(['name' => 'Admin OPD']);

        foreach (config('permission.list_permissions') as $permission) {
            foreach ($permission['lists'] as $list) {
                Permission::create(['name' => $list]);
            }
        }

        $userSuperAdmin = User::first();
        $userSuperAdmin->assignRole('super admin');
        $roleSuperAdmin->givePermissionTo(Permission::all());
    }
}
