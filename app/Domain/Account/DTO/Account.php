<?php


namespace App\Domain\Account\DTO;

use App\Domain\DTO\AbstractDTO;

/**
 * Class Account
 * @package App\Domain\Account\DTO
 * @property string $avatar
 * @property int $current_user_id
 * @property string $email
 * @property string $name
 * @property int $organization_id
 * @property int $user_id
 * @property string $password
 * @property string $position
 * @property string $role
 */
class Account extends AbstractDTO
{
    public string $avatar;
    public int $current_user_id;
    public string $email;
    public string $name;
    public int $organization_id;
    public int $user_id;
    public string $password;
    public string $position;
    public string $role;
}
