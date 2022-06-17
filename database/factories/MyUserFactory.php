<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyUser>
 */
class MyUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'name'=>$this->faker->name(),
            'phone'=>$this->faker->phoneNumber(),
            'national_code'=>$this->faker->numberBetween(1000000,9999999),
            'car_type'=>$this->faker->word(),
            'email'=>$this->faker->email(),
            'plaque'=>$this->faker->word(),
            'password'=>Hash::make("123")
            
            
        ];
    }
}
