<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\BookRating;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Repositories\BookRepository;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Controllers\Traits\ResponserTrait;
use App\Http\Requests\BookReviewRatingStoreRequest;

class BookApiController extends Controller
{
    use ResponserTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = BookRepository::getAll();
        return $this->respondCollection('success', BookResource::collection($books));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $book = BookService::store($request->validated());
        return $this->respondCollection('success', new BookResource($book));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $this->respondCollection('success', new BookResource($book));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $bookUpdate = BookService::update($request->validated(), $book);
        return $this->respondCollection('success', new BookResource($bookUpdate));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->respondCreateMessageOnly('success');
    }

    public function reviewRating(BookReviewRatingStoreRequest $request)
    {
        $checkRateUser = BookRating::where('user_id', $request->user_id)->where('book_id', $request->book_id)->first();
        
        if($checkRateUser)
        {
            return $this->respondCreateMessageOnly('This user is rated at this book.');
        }
        
        $book = BookService::storeReviewRating($request);
        return $this->respondCollection('success', new BookResource($book));
    }

    public function report()
    {
        $books = BookRepository::getReportList();
        return response()->json($books);
        return $this->respondCollection('success', BookResource::collection($books));
    }
}
