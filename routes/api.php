<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']);

Route::get('/manufacturers', function () {
    return response()->json([
        'success' => true,
        'data' => \App\Models\Manufacturer::all(),
        'error_message' => null,
    ]);
});

Route::get('/colors', function () {
    return response()->json([
        'success' => true,
        'data' => \App\Models\Color::all(),
        'error_message' => null,
    ]);
});

Route::get('/features', function () {
    return response()->json([
        'success' => true,
        'data' => \App\Models\Feature::all(),
        'error_message' => null,
    ]);
});