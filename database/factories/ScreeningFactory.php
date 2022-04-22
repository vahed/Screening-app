<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'dateOfBirth' => $this->faker->date(),
            'headacheFrequency' => $this->faker->randomLetter(),
            'headacheLevel' => $this->faker->randomNumber(),
            'assignedTo' => $this->faker->randomLetter()
        ];
    }
}
