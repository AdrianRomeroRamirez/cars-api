<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class Controller
{
    protected function callService(callable $method, int $statusCode = 200)
    {
        try {
            $result = $method();

            return response()->json([
                'success' => true,
                'data' => $result,
                'error_message' => null,
            ], $statusCode);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error_message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error_message' => 'Resource not found',
            ], 404);
        } catch (Throwable $e) {
            Log::error($e);

            return response()->json([
                'success' => false,
                'data' => null,
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
