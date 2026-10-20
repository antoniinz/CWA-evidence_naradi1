<?php

namespace App\Http\Requests;

use App\Enums\EquipmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'inventory_number' => [
                'required', 'string', 'max:50',
                Rule::unique('equipment', 'inventory_number')->ignore($this->route('equipment')),
            ],
            'status' => ['required', Rule::enum(EquipmentStatus::class)],
            'purchased_at' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'název',
            'inventory_number' => 'evidenční číslo',
            'status' => 'stav',
            'purchased_at' => 'datum nákupu',
        ];
    }
}
