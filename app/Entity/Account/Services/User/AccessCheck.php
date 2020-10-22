<?php


namespace App\Entity\Account\Repositories\Services\User;


use App\Entity\Account\Entities\User;
use Illuminate\Support\Arr;

class AccessCheck
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    const ACTIONS = [
        self::CREATE, self::UPDATE, self::DELETE,
    ];

    public function can(User $user, string $action, $role): bool
    {
        if (!$this->isValidAction($action)) {
            throw new \Exception(trans('error.permission', ['perm' => $action]));
        }

        $permission = $this->format($action, $role);

        if ($user->cannot($permission)) {
            throw new \Exception('error.access.permission', [
                'user' => $user->getName(),
                'perm' => $permission
            ]);
        }
    }

    private function isValidAction(string $action): bool
    {
        return Arr::has(self::ACTIONS, $action);
    }

    private function format(string $action, string $role): string
    {
        return $action . '_' . $role;
    }
}
