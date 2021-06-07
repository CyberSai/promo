<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Location\Coordinate;

class StoreEventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255',],
            'description' => ['nullable', 'string',],
            'date' => ['required', 'date'],
            'coordinate.lat' => ['required', 'numeric',],
            'coordinate.lng' => ['required', 'numeric',],
        ];
    }
}
