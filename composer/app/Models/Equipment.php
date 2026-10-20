<?php

namespace App\Models;

use App\Enums\EquipmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $table = 'equipment';

    protected $fillable = ['name', 'inventory_number', 'status', 'purchased_at'];

    protected $casts = [
        'status' => EquipmentStatus::class,
        'purchased_at' => 'date',
    ];

    public function serviceRecords(): HasMany
    {
        return $this->hasMany(ServiceRecord::class)->orderByDesc('serviced_at');
    }
}
