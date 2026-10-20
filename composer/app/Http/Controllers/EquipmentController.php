<?php

namespace App\Http\Controllers;

use App\Enums\EquipmentStatus;
use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $status = EquipmentStatus::tryFrom((string) $request->query('status'));

        $equipment = Equipment::query()
            ->withSum('serviceRecords as total_cost', 'cost')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('equipment.index', compact('equipment', 'status'));
    }

    public function create()
    {
        return view('equipment.create', ['equipment' => new Equipment(['status' => EquipmentStatus::Active])]);
    }

    public function store(EquipmentRequest $request)
    {
        $equipment = Equipment::create($request->validated());

        return redirect()->route('equipment.show', $equipment)->with('success', 'Zařízení bylo vytvořeno.');
    }

    public function show(Equipment $equipment)
    {
        $equipment->load('serviceRecords');
        $totalCost = $equipment->serviceRecords->sum('cost');

        return view('equipment.show', compact('equipment', 'totalCost'));
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->validated());

        return redirect()->route('equipment.show', $equipment)->with('success', 'Zařízení bylo upraveno.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Zařízení bylo smazáno.');
    }
}
