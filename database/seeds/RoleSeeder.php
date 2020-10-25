<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['super_admin', 'admin', 'manager', 'developer', 'qa'];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}
