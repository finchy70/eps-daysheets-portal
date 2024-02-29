<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Mileage;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MileageFactory extends Factory
{
    protected $model = Mileage::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory()->create(),
            'rate' => $this->faker->randomFloat('2', .30, 1.00),
            'valid_from' => Carbon::now()->subDays(20),
            'valid_to' => Carbon::now()->addDays(6),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
