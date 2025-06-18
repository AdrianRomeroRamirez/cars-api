<?php

namespace App\Services;

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
}
