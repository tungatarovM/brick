<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['super_admin', 'admin', 'manager', 'developer', 'qa'];

        foreach ($roles as $roleName) {
            $role = new Role([
                'name' => $roleName,
                'guard_name' => 'web', // TODO and api guard
            ]);

            $role->save();
        }
    }
}
