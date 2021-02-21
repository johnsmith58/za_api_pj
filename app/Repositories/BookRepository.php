<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public static function getAll()
    {
        return Book::all();
    }

    public static function getReportList()
    {
        $books = Book::all()->sortByDesc('averageRating')->take(5);
        
        //groupBy average rating
        // $books = Book::all()->sortByDesc('averageRating')->groupBy(function($book){
        //     return (int)$book->averageRating;
        // });
        return $books;
    }
}
