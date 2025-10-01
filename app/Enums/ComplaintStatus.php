<?php

namespace App\Enums;

enum ComplaintStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Baru',
            self::IN_PROGRESS => 'Diproses',
            self::RESOLVED => 'Selesai',
            self::REJECTED => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::NEW => 'blue',
            self::IN_PROGRESS => 'yellow',
            self::RESOLVED => 'green',
            self::REJECTED => 'red',
        };
    }

    public static function options(): array
    {
        return [
            self::NEW->value => self::NEW->label(),
            self::IN_PROGRESS->value => self::IN_PROGRESS->label(),
            self::RESOLVED->value => self::RESOLVED->label(),
            self::REJECTED->value => self::REJECTED->label(),
        ];
    }
}