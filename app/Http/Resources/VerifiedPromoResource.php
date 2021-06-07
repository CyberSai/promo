<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VerifiedPromoResource extends JsonResource
{
    protected $polyline;

    public function __construct($resource, $polyline)
    {
        $this->polyline = $polyline;
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'promo' => new PromoResource($this->resource),
            'polyline' => $this->polyline,
        ];
    }
}
