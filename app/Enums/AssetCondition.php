<?php

namespace App\Enums;

enum AssetCondition: string
{
    case GOOD = 'good';
    case MINOR_DAMAGE = 'minor_damage';
    case MAJOR_DAMAGE = 'major_damage';
    case NEEDS_REPAIR = 'needs_repair';

    public function label(): string
    {
        return match($this) {
            self::GOOD => 'Baik',
            self::MINOR_DAMAGE => 'Rusak Ringan',
            self::MAJOR_DAMAGE => 'Rusak Berat',
            self::NEEDS_REPAIR => 'Perlu Perbaikan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::GOOD => 'green',
            self::MINOR_DAMAGE => 'yellow',
            self::MAJOR_DAMAGE => 'red',
            self::NEEDS_REPAIR => 'orange',
        };
    }

    public static function options(): array
    {
        return [
            self::GOOD->value => self::GOOD->label(),
            self::MINOR_DAMAGE->value => self::MINOR_DAMAGE->label(),
            self::MAJOR_DAMAGE->value => self::MAJOR_DAMAGE->label(),
            self::NEEDS_REPAIR->value => self::NEEDS_REPAIR->label(),
        ];
    }
}