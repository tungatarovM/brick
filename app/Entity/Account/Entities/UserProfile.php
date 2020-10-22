<?php

namespace App\Entity\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVE = 'archive';

    const SHIFT_START = '09:00';
    const SHIFT_END = '18:00';

    const DEFAULT_BREAK_TIME = '13:00-14:00';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift' => 'object',
        'breaks' => 'object',
    ];

    public static function defaultShiftTime(): \stdClass
    {
        $shift = new \stdClass();

        $shift->shift_start = self::SHIFT_START;
        $shift->shift_end = self::SHIFT_END;

        return $shift;
    }

    public static function defaultBreakTime(): \stdClass
    {
        $break = new \stdClass();

        $break->breaks = [ self::DEFAULT_BREAK_TIME ];

        return $break;
    }
}
