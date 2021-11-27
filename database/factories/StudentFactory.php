<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->word,
            'gender' => $this->faker,
            'field_of_study' => $this->faker->jobTitle,
            'governorate' => $this->faker->city,
            'university' => $this->faker->word,
            'date_of_birth' => $this->faker->dateTime('Y-m-d'),
        ];
    }
}
