<?php

namespace App\Entity\Account\Repositories\User;

use App\Entity\Account\Entities\User;
use App\Entity\Account\Entities\UserProfile;
use App\Entity\Account\Entities\UserProfileHelper;
use App\Entity\Account\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
     * @param array $attributes
     * @throws \Exception
     * @return User
     */
    public function create(array $attributes): User
    {
        if (!Arr::exists($attributes, 'role')) {
            throw new \Exception(trans('error.key', [ 'key' => 'role' ]));
        }

        try {
            DB::beginTransaction();

            $user = User::create($attributes);

            $user->profile()->create([
                'avatar' => $attributes['default_avatar'],
                'position' => $attributes['position'],
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

    public function update(array $attributes): User
    {
        if (!Arr::exists($attributes, 'id')) {
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
