<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookRating;
use App\Models\BookReview;

class BookService
{
    public static function store($request) : Book
    {
        return Book::create($request);
    }

    public static function update($request, $book) : Book
    {
        $book->update($request);
        return $book;
    }

    public static function storeReviewRating($request) : Book
    {
        $book = Book::find($request->book_id);

        if($book)
        {
            if($request->rating_number)
            {
                BookRating::create([
                    'book_id' => $book->id,
                    'user_id' => $request->user_id,
                    'rating_number' => $request->rating_number
                ]);
            }
            if($request->review)
            {
                BookReview::create([
                    'book_id' => $book->id,
                    'user_id' => $request->user_id,
                    'review' => $request->review
                ]);
            }
        }

        return $book;

    }
}
