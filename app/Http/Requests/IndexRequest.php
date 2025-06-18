<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_by' => 'string|nullable',
            'order_by' => 'string|nullable',
            'offset' => 'integer|nullable',
            'limit' => 'integer|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'sort_by.string' => 'The sort_by must be a string.',
            'order_by.string' => 'The order_by must be a string.',
            'offset.integer' => 'The offset must be an integer.',
            'limit.integer' => 'The limit must be an integer.',
        ];
    }

    public function getOffset(): int
    {
        return $this->input('offset', 0);
    }

    public function getLimit(): int
    {
        return $this->input('limit', 10);
    }

    public function getOrderBy(): string
    {
        return $this->input('order_by', 'created_at');
    }

    public function getSortBy(): string
    {
        return $this->input('sort_by', 'desc');
    }
}