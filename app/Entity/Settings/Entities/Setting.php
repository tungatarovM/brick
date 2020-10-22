<?php

namespace App\Entity\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class Setting extends Model
{
    protected $table = 'application_settings';

    protected $fillable = [
        'setting_key', 'setting_value',
    ];

    public function defaultAvatarByRole(string $role): string
    {
        $avatars = $this->byKey('default_avatars');

        $this->checkProperty($avatars, $role);

        return $avatars->$role;
    }

    public function defaultPositionByRole(string $role): string
    {
        $positions = $this->byKey('default_positions');

        $this->checkProperty($positions, $role);

        return $positions->$role;
    }

    public function byKey(string $key)
    {
        $value = $this->select('setting_value')
            ->where('setting_key', $key)
            ->first();

        if (is_null($value)) {
            throw new \Exception("Setting with given key $key not found");
        }

        return $value;
    }

    private function checkProperty(stdClass $settingValue, string $property)
    {
        if (!property_exists($settingValue, $property)) {
            throw new \Exception("Setting property $property not does not exists");
        }
    }
}
