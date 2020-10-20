<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Organization;

class UserSeeder extends Seeder
{
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Organization::class, 2)->create()->each(function ($organization) {
           $this->createUser($organization->id, User::ROLE_ADMIN, 1);
           $this->createUser($organization->id, User::ROLE_MANAGER, 2);
           $this->createUser($organization->id, User::ROLE_DEVELOPER, 3);
           $this->createUser($organization->id, User::ROLE_QA, 3);
        });
    }

    private function createUser(int $organizationId, string $role = User::ROLE_ADMIN, int $count = 1)
    {

        for ($index = 0; $index < $count; $index += 1) {

            $user = User::create([
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => Hash::make('123123123'),
                'organization_id' => $organizationId,
            ]);

            $user->assignRole($role);
        }
    }
}
