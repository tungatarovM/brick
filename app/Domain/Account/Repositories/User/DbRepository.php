<?php

namespace App\Domain\Account\Repositories\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Domain\Account\Entities\User;
use App\Domain\Account\Entities\UserProfile;
use App\Domain\Account\DTO\Account as AccountDTO;

class DbRepository implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param AccountDTO $attributes
     * @throws \Exception
     * @return User
     */
    public function create(AccountDTO $attributes): User
    {
        if ($attributes->filled('role')) {
            throw new \Exception(trans('error.key', [ 'key' => 'role' ]));
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $attributes->name,
                'email' => $attributes->email,
                'password' => Hash::make($attributes->password),
                'organization' => $attributes->organization_id,
            ]);

            $user->profile()->create([
                'avatar' => $attributes->avatar,
                'position' => $attributes->position,
                'status' => UserProfile::STATUS_ACTIVE,
                'shift' => UserProfile::defaultShiftTime(),
                'break' => UserProfile::defaultBreakTime(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $user;
    }

    /**
     * @param AccountDTO $attributes
     * @return User
     * @throws \Exception
     */
    public function update(AccountDTO $attributes): User
    {
        if (!$attributes->filled('id')) {
            throw new \Exception(trans('account.validation.required', [ 'key' => 'id' ]));
        }

        $user = User::findOrFail($attributes['id']);

        try {
            DB::beginTransaction();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(int $id): void
    {

    }
}
