<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Promo;
use App\Support\PromoCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromoFactory extends Factory
{
    protected $model = Promo::class;

    public function definition()
    {
        return [
            'code' => PromoCode::generate(),
            'amount' => $this->faker->randomFloat(2, 2, 15),
            'radius' => $this->faker->randomFloat(),
            'event_id' => Event::factory(),
        ];
    }

    public function inactive()
    {
        return $this->state(['active' => false,]);
    }
}
