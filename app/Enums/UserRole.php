<?php

namespace App\Enums;

enum UserRole: string
{
    case STAFF_IT = 'staff_it';
    case PRINCIPAL = 'principal';
    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::STAFF_IT => 'Staff IT',
            self::PRINCIPAL => 'Principal',
            self::USER => 'User',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::STAFF_IT => 'Administrator dan pelaksana teknis utama sistem',
            self::PRINCIPAL => 'Pengawas manajerial yang memantau kinerja dan alur kerja',
            self::USER => 'Pengguna akhir yang berinteraksi dengan sistem untuk kebutuhan pribadi',
        };
    }

    public static function options(): array
    {
        return [
            self::STAFF_IT->value => self::STAFF_IT->label(),
            self::PRINCIPAL->value => self::PRINCIPAL->label(),
            self::USER->value => self::USER->label(),
        ];
    }

    public function permissions(): array
    {
        return match($this) {
            self::STAFF_IT => [
                'assets.create',
                'assets.read',
                'assets.update',
                'assets.delete',
                'assets.assign',
                'complaints.read_all',
                'complaints.update',
                'complaints.assign',
                'users.create',
                'users.read',
                'users.update',
                'users.delete',
                'calendar.read',
                'reports.read',
            ],
            self::PRINCIPAL => [
                'assets.read',
                'complaints.read_all',
                'calendar.read',
                'reports.read',
                'reports.export',
            ],
            self::USER => [
                'assets.read_own',
                'complaints.create',
                'complaints.read_own',
                'reports.read_own',
            ],
        };
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions());
    }
}