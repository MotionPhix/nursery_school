<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [

      'first_name' => fake('en_ZA')->firstName,
      'last_name' => fake('en_ZA')->lastName,
      'birthday' => fake('en_ZA')->dateTimeBetween('-10 years', '-2 years')
    ];
  }
}
