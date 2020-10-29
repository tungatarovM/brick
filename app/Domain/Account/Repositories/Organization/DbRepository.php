<?php


namespace App\Domain\Account\Repositories\Organization;


use App\Domain\Account\DTO\Account as AccountDTO;
use App\Domain\Account\Entities\Organization;

class DbRepository implements OrganizationRepositoryInterface
{
    public function get(int $id): Organization
    {

    }

    public function create(AccountDTO $attributes): Organization
    {

    }

    public function update(AccountDTO $attributes): Organization
    {

    }

    public function delete(int $id): void
    {

    }
}
