<?php

namespace Database\Factories;

use App\Models\Mileage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MileageFactory extends Factory{
    protected $model = Mileage::class;

    public function definition(): array
    {
        return [
            'client_id' => $this->faker->randomNumber(),//
'rate' => $this->faker->randomFloat(),
'valid_from' => Carbon::now(),
'valid_to' => Carbon::now(),
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
        ];
    }
}
