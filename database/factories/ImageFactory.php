<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,15),
            'image_path' => $this->faker->randomElement([Str::random(8).".jpg",Str::random(6).".png",Str::random(4)]),
            'description' => $this->faker->paragraph(8,true)
        ];
    }
}
