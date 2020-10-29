<?php


namespace App\Domain\Access\Checker;


use App\Domain\Account\Entities\User;
use App\Domain\Account\Exceptions\PermissionException;
use Illuminate\Support\Arr;

class AccessChecker implements CheckerInterface
{

    /**
     * @param User $user
     * @param string $action
     * @param $role
     * @return bool
     * @throws PermissionException
     */
    public function can(User $user, string $action, $role): bool
    {
        if (!$this->isValidAction($action)) {
            throw new PermissionException(trans('error.permission', ['perm' => $action]));
        }

        $permission = $this->format($action, $role);

        if ($user->cannot($permission)) {
            throw new PermissionException('error.access.permission', [
                'user' => $user->getName(),
                'perm' => $permission
            ]);
        }
    }

    /**
     * @param string $action
     * @return bool
     */
    private function isValidAction(string $action): bool
    {
        return Arr::has(self::ACTIONS, $action);
    }

    /**
     * @param string $action
     * @param string $role
     * @return string
     */
    private function format(string $action, string $role): string
    {
        return $action . '_' . $role;
    }
}
