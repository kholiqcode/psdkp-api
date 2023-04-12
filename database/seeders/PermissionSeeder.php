<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SHIP
        $shipPermissions = [
            'ship.*',
            'ship.create',
            'ship.read',
            'ship.update',
            'ship.edit',
            'ship.delete',
            'ship.verify',
        ];

        // USER
        $userPermissions = [
            'user.*',
            'user.create',
            'user.read',
            'user.update',
            'user.edit',
            'user.delete',
            'user.verify.otp',
            'user.verify',
        ];

        $permissions = array_map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'api'];
        }, array_merge($shipPermissions, $userPermissions));

        Permission::insert($permissions);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleUser = Role::create(['name' => 'user']);
        $roleUser->givePermissionTo('user.create', 'user.read', 'user.update', 'user.edit', 'user.delete', 'user.verify.otp');
    }
}
