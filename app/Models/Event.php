<?php

namespace App\Models;

use App\Casts\Coordinate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'coordinate',
    ];

    protected $casts = [
        'coordinate' => Coordinate::class,
    ];

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }
}
