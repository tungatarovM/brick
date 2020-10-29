<?php


namespace App\Domain\Access\Checker;


use App\Domain\Account\Entities\User;

interface CheckerInterface
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    const ACTIONS = [
        self::CREATE, self::UPDATE, self::DELETE,
    ];

    public function can(User $user, string $action, string $role): bool;
}
