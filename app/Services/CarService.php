<?php

namespace App\Services;

use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;

class CarService
{
    public function index(IndexRequest $request): array
    {
        $cars = Car::with(['manufacturer', 'colors', 'features'])
            ->orderBy($request->getOrderBy(), $request->getSortBy())
            ->offset($request->getOffset())
            ->limit($request->getLimit())
            ->get();

        return CarResource::collection($cars)->resolve();
    }

    public function store(CreateCarRequest $request): bool
    {
        $car = Car::create([
            'model' => $request->getModel(),
            'year' => $request->getYear(),
            'engine_type' => $request->getEngineType(),
            'description' => $request->getDescription(),
            'manufacturer_id' => $request->getManufacturerId(),
        ]);

        $car->colors()->sync($request->getColors());
        $car->features()->sync($request->getFeatures());

        return true;
    }
}
