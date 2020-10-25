<?php

namespace App\Entity\Account\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organization
 * @package App\Entity\Account\Entities
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $address
 */
class Organization extends Model
{
    protected $table = 'organizations';

    protected $guarded = [];

    public function staff()
    {
        return $this->hasMany(User::class, 'organization_id', 'id');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
