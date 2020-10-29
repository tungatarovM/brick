<?php


namespace App\Domain\Account\Repositories\Organization;

use App\Domain\Account\Entities\Organization;
use App\Domain\Account\DTO\Account as AccountDTO;

interface OrganizationRepositoryInterface
{
    public function get(int $id): Organization;

    public function create(AccountDTO $attributes): Organization;

    public function update(AccountDTO $attributes): Organization;

    public function delete(int $id): void;
}
