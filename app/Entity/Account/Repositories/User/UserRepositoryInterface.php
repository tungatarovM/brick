<?php


namespace App\Entity\Account\Repositories\User;

use App\Entity\Account\Entities\User;

interface UserRepositoryInterface
{
    public function get(int $id): User;

    public function create(array $attirbutes): User;

    public function update(array $attributes): User;

    public function delete(int $id): void;
}
