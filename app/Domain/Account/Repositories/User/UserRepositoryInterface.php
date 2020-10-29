<?php


namespace App\Domain\Account\Repositories\User;

use App\Domain\Account\Entities\User;
use App\Domain\Account\DTO\Account as AccountDTO;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User;

    /**
     * @param AccountDTO $attirbutes
     * @return User
     */
    public function create(AccountDTO $attirbutes): User;

    /**
     * @param AccountDTO $attributes
     * @return User
     */
    public function update(AccountDTO $attributes): User;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
