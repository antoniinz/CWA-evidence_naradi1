<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Vrtačka Bosch GSB 18V', 'NAR-001', 'active', '2022-03-15', [
                ['Výměna uhlíků', '2023-06-10', 350.00],
                ['Výměna akumulátoru', '2024-09-02', 1890.50],
            ]],
            ['Úhlová bruska Makita 125', 'NAR-002', 'service', '2021-11-02', [
                ['Oprava vypínače', '2025-01-20', 620.00],
            ]],
            ['Kompresor 50 l', 'NAR-003', 'retired', '2018-05-20', [
                ['Výměna pístu', '2021-02-11', 2400.00],
            ]],
            ['Pila přímočará Metabo', 'NAR-004', 'active', '2024-01-10', []],
        ];

        foreach ($items as [$name, $number, $status, $purchased, $records]) {
            $equipment = Equipment::create([
                'name' => $name,
                'inventory_number' => $number,
                'status' => $status,
                'purchased_at' => $purchased,
            ]);

            foreach ($records as [$description, $date, $cost]) {
                $equipment->serviceRecords()->create([
                    'description' => $description,
                    'serviced_at' => $date,
                    'cost' => $cost,
                ]);
            }
        }
    }
}
