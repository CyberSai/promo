<?php

namespace App\Models;

use Location\Coordinate;
use Location\Distance\Vincenty;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidCoordinateException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Location\Formatter\Polyline\GeoJSON;
use Location\Polyline;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'active',
        'radius',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function isExpired()
    {
        return now()->greaterThan($this->event->date);
    }

    public function withinRadius($coordinate)
    {
        if (is_array($coordinate) && array_key_exists('lat', $coordinate) && array_key_exists('lng', $coordinate)) {
            $coordinate = new Coordinate($coordinate['lat'], $coordinate['lng']);
        }

        if (!$coordinate instanceof Coordinate) {
            throw new InvalidCoordinateException();
        }

        return (new Vincenty)->getDistance($this->event->coordinate, $coordinate) <= $this->radius;
    }

    public function createPolyline($origin, $destination)
    {
        if (is_array($origin) && array_key_exists('lat', $origin) && array_key_exists('lng', $origin)) {
            $origin = new Coordinate($origin['lat'], $origin['lng']);
        }

        if (is_array($destination) && array_key_exists('lat', $destination) && array_key_exists('lng', $destination)) {
            $destination = new Coordinate($destination['lat'], $destination['lng']);
        }

        if (!$origin instanceof Coordinate || !$destination instanceof Coordinate) {
            throw new InvalidCoordinateException();
        }

        $polyline = new Polyline;
        $polyline->addPoints([$origin, $destination,]);

        return json_decode($polyline->format(new GeoJSON), true);
    }
}
