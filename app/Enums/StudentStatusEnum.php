<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StudentStatusEnum extends Enum
{
    public const DI_HOC = 1;
    public const BO_HOC = 2;
    public const BAO_LUU = 3;

    public static function getArrayView(): array
    {
        return [
            'Đi học'  => self::DI_HOC,
            'Bỏ học'  => self::BO_HOC,
            'Bảo lưu' => self::BAO_LUU,
        ];
    }
}
