<?php

namespace Database\Factories;

use App\Models\Event;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Location\Coordinate;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => (new DateTime())
                ->add(date_interval_create_from_date_string("{$this->faker->numberBetween(2, 180)} days"))
                ->format('Y-m-d'),
            'coordinate' => new Coordinate(
                $this->faker->latitude,
                $this->faker->longitude
            ),
        ];
    }

    public function past()
    {
        return $this->state([
            'date' => $this->faker->date('Y-m-d', '-2 days'),
        ]);
    }
}
