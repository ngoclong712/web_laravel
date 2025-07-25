<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StudentsStatusEnum extends Enum
{
    public const ENROLLED = 1;
    public const DROPPED_OUT = 2;
    public const ON_LEAVE = 3;

    public static function getArrayView()
    {
        return [
            'Enrolled' => self::ENROLLED,
            'Dropped' => self::DROPPED_OUT,
            'On Leave' => self::ON_LEAVE,
        ];
    }
}
