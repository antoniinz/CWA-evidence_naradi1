<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $purchased = $this->route('equipment')->purchased_at->toDateString();

        return [
            'description' => ['required', 'string', 'max:255'],
            'serviced_at' => ['required', 'date_format:Y-m-d', 'before_or_equal:today', "after_or_equal:$purchased"],
            'cost' => ['required', 'numeric', 'min:0', 'decimal:0,2', 'max:99999999.99'],
        ];
    }

    public function attributes(): array
    {
        return [
            'description' => 'popis',
            'serviced_at' => 'datum servisu',
            'cost' => 'cena',
        ];
    }
}
