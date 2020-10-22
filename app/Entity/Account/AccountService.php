<?php


namespace App\Entity\Account;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Entity\Account\Entities\User;
use App\Entity\Settings\Entities\Setting;
use App\Entity\Account\Repositories\Organization\OrganizationRepositoryInterface;
use App\Entity\Account\Repositories\Services\User\AccessCheck;
use App\Entity\Account\Repositories\User\UserRepositoryInterface;

class AccountService
{
    private $access;
    private $users;
    private $organizations;
    private $settings;

    /**
     * AccountService constructor.
     * @param AccessCheck $checker
     * @param UserRepositoryInterface $users
     * @param OrganizationRepositoryInterface $organizations
     * @param Setting $settings
     */
    public function __construct(
        AccessCheck $checker,
        UserRepositoryInterface  $users,
        OrganizationRepositoryInterface $organizations,
        Setting $settings
    )
    {
        $this->access = $checker;
        $this->users = $users;
        $this->organizations = $organizations;
        $this->settings = $settings;
    }

    /**
     * @param array $attributes
     * @return User
     * @throws \Exception
     */
    public function create(array $attributes): User
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes['current_user_id']);

        $this->access->can($user, $this->access::CREATE, $attributes['role']);

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param array $attributes
     * @return User
     * @throws \Exception
     */
    public function register(array $attributes): User
    {
        if (!Arr::exists($attributes, 'role')) {
            throw new \Exception(trans('error.key', [ 'key' => 'role' ]));
        }

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param array $attributes
     * @return User
     * @throws \Exception
     */
    public function addStaff(array $attributes): User
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes['current_user_id']);

        $this->access->can($user, $this->access::CREATE, $attributes['role']);

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param array $attributes
     * @throws \Exception
     */
    public function deleteStaff(array $attributes): void
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes['current_user_id']);
        $deletingUser = $this->users->get($attributes['user_id']);

        $this->access->can($user, $this->access::DELETE, $deletingUser->getRole());

        $this->users->delete($deletingUser->id);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $user = $this->users->get($id);

        try {
            DB::beginTransaction();

            if ($user->isAdmin()) {
                $organization = $this->organizations->get($user->getOrganization());
                $this->organizations->delete($organization->id);
            }

            $this->users->delete($id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function archive(array $attributes): void
    {

    }

    /**
     * @param array $attributes
     * @return User
     * @throws \Exception
     */
    private function store(array $attributes): User
    {
        try {
            DB::beginTransaction();

            if (!Arr::has($attributes, 'organization_id')) {
                $organization = $this->organizations->create($attributes);

                $attributes['organization_id'] = $organization->id;
            }

            $user = $this->users->create($attributes);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $user;
    }

    /**
     * @param array $attributes
     * @throws \Exception
     */
    private function validate(array $attributes)
    {
        if (!Arr::has($attributes, 'current_user_id')) {
            throw new \Exception(trans('error.key', ['key' => 'current_user_id']));
        }

        if (!Arr::has($attributes, 'role')) {
            throw new \Exception(trans('error.key', ['key' => 'role']));
        }
    }

    /**
     * @param array $attributes
     * @return array
     */
    private function setDefaultAttributes(array $attributes): array
    {
        $attributes['position'] = $attributes['position']
            ?? $this->settings->defaultPositionByRole($attributes['role']);
        $attributes['avatar'] = $attributes['avatar']
            ?? $this->settings->defaultAvatarByRole($attributes['role']);

        return $attributes;
    }
}
