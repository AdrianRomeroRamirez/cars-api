<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\IndexRequest;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function __construct(private CarService $service) {}
    
    public function index(IndexRequest $request): JsonResponse
    {
        return $this->callService(fn() => $this->service->index($request));
    }

    public function store(CreateCarRequest $request)
{
    return $this->callService(fn() => $this->service->store($request), 201);
}
}
