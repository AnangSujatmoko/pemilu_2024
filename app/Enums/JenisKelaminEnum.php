<?php

namespace App\Enums;

enum JenisKelaminEnum: int
{
    case LAKI = 0;
    case PEREMPUAN = 1;

    public function label()
    {
        return match ($this) {
            self::LAKI => 'Laki - Laki',
            self::PEREMPUAN => 'Perempuan',
        };
    }
}
