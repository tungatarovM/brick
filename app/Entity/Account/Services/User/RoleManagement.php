<?php


namespace App\Entity\Account\Services\User;


use Spatie\Permission\Models\Role;

class RoleManagement
{
    public function givePermissionToRole(string $roleName, string $permission): void
    {
        $role = Role::findByName($roleName);

        $role->givePermissionTo($permission);
    }

    public function revokePermissionFrom(string $roleName, string $permission): void
    {
        $role = Role::findByName($roleName);

        $role->revokePermissionTo($permission);
    }

    public function create(string $roleName): Role
    {
        return new Role(['name' => $roleName]);
    }
}
