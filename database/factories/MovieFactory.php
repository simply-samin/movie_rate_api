<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{   

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genres = $this->faker->randomElements(['Action', 'Comedy', 'Drama', 'Fantasy', 'Horror', 'Sci-Fi'], $count = 2);
        return [
            'title' => $this->faker->sentence,
            'release_year' => $this->faker->numberBetween(1900, date('Y')),
            'description' => $this->faker->paragraph,
            'poster_url' => $this->faker->imageUrl(),
            'genre' => json_encode($genres),
            'average_rating' => $this->faker->randomFloat(1, 1, 5),
            'total_ratings' => $this->faker->numberBetween(0, 1000),
        ];
    }
    
}
