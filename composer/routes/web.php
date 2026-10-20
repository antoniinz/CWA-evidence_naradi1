<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ServiceRecordController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/equipment');

Route::resource('equipment', EquipmentController::class);

Route::resource('equipment.service-records', ServiceRecordController::class)
    ->only(['store', 'destroy'])
    ->shallow();
