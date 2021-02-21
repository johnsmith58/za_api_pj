<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\BookReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookReview::class;

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
            'review' => $this->faker->paragraph
        ];
    }
}
