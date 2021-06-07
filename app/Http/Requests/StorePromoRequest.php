<?php

namespace App\Http\Requests;

use App\Rules\PromoCodeRule;
use App\Support\PromoCode;
use Illuminate\Foundation\Http\FormRequest;

class StorePromoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => ['required', new PromoCodeRule],
            'amount' => ['required', 'numeric'],
            'radius' => ['required', 'numeric'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('code')) {
            return;
        }

        $this->merge([
            'code' => PromoCode::generate(),
        ]);
    }
}
