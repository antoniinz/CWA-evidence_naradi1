<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRecordRequest;
use App\Models\Equipment;
use App\Models\ServiceRecord;

class ServiceRecordController extends Controller
{
    public function store(ServiceRecordRequest $request, Equipment $equipment)
    {
        $equipment->serviceRecords()->create($request->validated());

        return redirect()->route('equipment.show', $equipment)->with('success', 'Servisní záznam byl přidán.');
    }

    public function destroy(ServiceRecord $serviceRecord)
    {
        $serviceRecord->delete();

        return back()->with('success', 'Servisní záznam byl smazán.');
    }
}
