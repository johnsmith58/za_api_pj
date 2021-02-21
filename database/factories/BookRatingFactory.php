<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\BookRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => Book::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'rating_number' => rand(1, 5)
        ];
    }
}
