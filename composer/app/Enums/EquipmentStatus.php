<?php

namespace App\Enums;

enum EquipmentStatus: string
{
    case Active = 'active';
    case Service = 'service';
    case Retired = 'retired';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Aktivní',
            self::Service => 'V servisu',
            self::Retired => 'Vyřazeno',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Service => 'warning',
            self::Retired => 'secondary',
        };
    }
}
