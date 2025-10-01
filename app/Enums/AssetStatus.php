<?php

namespace App\Enums;

enum AssetStatus: string
{
    case AVAILABLE = 'available';
    case IN_USE = 'in_use';
    case MAINTENANCE = 'maintenance';
    case DISPOSED = 'disposed';

    public function label(): string
    {
        return match($this) {
            self::AVAILABLE => 'Tersedia',
            self::IN_USE => 'Digunakan',
            self::MAINTENANCE => 'Dalam Perbaikan',
            self::DISPOSED => 'Dihapuskan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::AVAILABLE => 'green',
            self::IN_USE => 'blue',
            self::MAINTENANCE => 'yellow',
            self::DISPOSED => 'red',
        };
    }

    public static function options(): array
    {
        return [
            self::AVAILABLE->value => self::AVAILABLE->label(),
            self::IN_USE->value => self::IN_USE->label(),
            self::MAINTENANCE->value => self::MAINTENANCE->label(),
            self::DISPOSED->value => self::DISPOSED->label(),
        ];
    }
}