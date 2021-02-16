<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(["user","admin"]),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'nick' => $this->faker->userName,
            'email' => $this->faker->unique()->email,
            'email_verified_at' => now(),
            'password' => Str::random(round(rand(15,30))), // password
            'image' => $this->faker->randomElement([Str::random(10).".jpg",Str::random(8).".png",Str::random(8).".jpeg"]),
            'remember_token' => Str::random(10),
        ];
    }
}
