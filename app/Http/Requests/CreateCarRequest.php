<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . now()->year,
            'engine_type' => 'required|string',
            'description' => 'nullable|string',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ];
    }

    public function getModel(): string
    {
        return $this->input('model');
    }

    public function getYear(): int
    {
        return (int) $this->input('year');
    }

    public function getEngineType(): string
    {
        return $this->input('engine_type');
    }

    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    public function getManufacturerId(): int
    {
        return (int) $this->input('manufacturer_id');
    }

    public function getColors(): array
    {
        return $this->input('colors', []);
    }

    public function getFeatures(): array
    {
        return $this->input('features', []);
    }
}
