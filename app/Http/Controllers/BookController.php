<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function store(BookRequest $request)
    {
        Book::create($request->validated());
    }

    public function update(Book $book, BookRequest $request)
    {
        $book->update($request->validated());
    }
}
