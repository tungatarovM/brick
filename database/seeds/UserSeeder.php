<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Entity\Account\Entities\User;
use App\Entity\Account\Entities\UserProfile;
use App\Entity\Account\Entities\Organization;

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
        $settings = new \App\Entity\Settings\Entities\Setting();

        for ($index = 0; $index < $count; $index += 1) {

            try {
                DB::beginTransaction();

                $user = User::create([
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'password' => Hash::make('123123123'),
                    'organization_id' => $organizationId,
                ]);

                $user->profile()->create([
                    'avatar' => $settings->defaultAvatarByRole($role),
                    'position' => $settings->defaultPositionByRole($role),
                    'status' => UserProfile::STATUS_ACTIVE,
                    'shift' => UserProfile::defaultShiftTime(),
                    'breaks' => UserProfile::defaultBreakTime(),
                ]);

                $user->assignRole($role);
                DB::commit();
            } catch (\Throwable $e) {
                Db::rollBack();
                throw new \Exception($e->getMessage());
            }

        }
    }
}
