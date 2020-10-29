<?php


namespace App\Domain\Account;

use Illuminate\Support\Facades\DB;

use App\Domain\DTO\AbstractDTO;
use App\Domain\Account\Entities\User;
use App\Domain\Settings\Entities\Setting;
use App\Domain\Account\DTO\Account as AccountDTO;
use App\Domain\Account\Repositories\Organization\OrganizationRepositoryInterface;
use App\Domain\Access\AccessChecker;
use App\Domain\Account\Repositories\User\UserRepositoryInterface;
use App\Domain\Account\Exceptions\AccountCreationException;
use App\Domain\Account\Exceptions\FieldRequiredException;

/**
 * Class AccountService
 * @package App\Domain\Account
 * @property AccessChecker $access
 * @property UserRepositoryInterface $users
 * @property OrganizationRepositoryInterface $organizations
 * @property Setting $settings
 */
class AccountService
{
    private AccessChecker $access;
    private UserRepositoryInterface $users;
    private OrganizationRepositoryInterface $organizations;
    private Setting $settings;

    /**
     * AccountService constructor.
     * @param AccessChecker $checker
     * @param UserRepositoryInterface $users
     * @param OrganizationRepositoryInterface $organizations
     * @param Setting $settings
     */
    public function __construct(
        AccessChecker $checker,
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
     * @param AccountDTO $attributes
     * @return User
     * @throws \Throwable
     */
    public function create(AccountDTO $attributes): User
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes->current_user_id);

        $this->access->can($user, $this->access::CREATE, $attributes->role);

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param AccountDTO $attributes
     * @return User
     * @throws \Exception
     */
    public function register(AccountDTO $attributes): User
    {
        $this->validate($attributes, true);

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param AccountDTO $attributes
     * @return User
     * @throws \Throwable
     */
    public function addStaff(AccountDTO $attributes): User
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes->current_user_id);

        $this->access->can($user, $this->access::CREATE, $attributes->role);

        $attributes = $this->setDefaultAttributes($attributes);

        return $this->store($attributes);
    }

    /**
     * @param AccountDTO $attributes
     * @throws \Throwable
     */
    public function deleteStaff(AccountDTO $attributes): void
    {
        $this->validate($attributes);

        $user = $this->users->get($attributes->current_user_id);
        $deletingUser = $this->users->get($attributes->user_id);

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
     * @param AccountDTO $attributes
     * @return User
     * @throws AccountCreationException
     */
    private function store(AccountDTO $attributes): User
    {
        try {
            DB::beginTransaction();

            if (!$attributes->filled('organization_id')) {
                $organization = $this->organizations->create($attributes);
                $attributes->organization_id = $organization->id;
            }

            $user = $this->users->create($attributes);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new AccountCreationException($e->getMessage());
        }

        return $user;
    }

    /**
     * @param AbstractDTO $dto
     * @param bool $registration
     * @throws FieldRequiredException
     */
    private function validate(AbstractDTO  $dto, bool $registration = false)
    {
        $fields = $this->getCheckFields($registration);

        foreach ($fields as $key => $value) {
            if (!$dto->filled($key)) {
                throw new FieldRequiredException(trans('error.key', ['key' => $key]));
            }
        }
    }

    /**
     * @param bool $registration
     * @return string[]|\string[][]
     */
    private function getCheckFields(bool $registration = false): array
    {
        $main = [
            'name', 'email', 'password',
        ];

        $additional = [
            'current_user_id', 'role',
        ];

        return $registration
            ? $main
            : [ ...$main, ...$additional ];
    }

    /**
     * @param AccountDTO $attributes
     * @return AccountDTO
     */
    private function setDefaultAttributes(AccountDTO $attributes): AccountDTO
    {
        $attributes->position = $attributes->filled('position')
            ?? $this->settings->defaultPositionByRole($attributes->role);
        $attributes->avatar = $attributes->filled('avatar')
            ?? $this->settings->defaultAvatarByRole($attributes->role);

        return $attributes;
    }
}
