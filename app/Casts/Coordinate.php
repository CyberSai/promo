<?php

namespace App\Casts;

use App\Exceptions\InvalidCoordinateException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Location\Coordinate as LocationCoordinate;

class Coordinate implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $coordinate = json_decode($value, true);

        return new LocationCoordinate(
            $coordinate['lat'],
            $coordinate['lng'],
        );
    }

    public function set($model, $key, $value, $attributes)
    {
        if (is_array($value) && array_key_exists('lat', $value) && array_key_exists('lng', $value)) {
            $value = new LocationCoordinate($value['lat'], $value['lng']);
        }

        if (!$value instanceof LocationCoordinate) {
            throw new InvalidCoordinateException();
        }

        return json_encode([
            'lat' => $value->getLat(),
            'lng' => $value->getLng(),
        ]);
    }
}
