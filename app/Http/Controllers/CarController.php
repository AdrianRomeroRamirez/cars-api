<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function index(): JsonResponse
    {
        $cars = Car::with(['manufacturer', 'colors', 'features'])->get();

        return response()->json($cars);
    }
}
