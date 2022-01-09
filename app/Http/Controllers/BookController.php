<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store()
    {
        $data = $this->validate(\request(), [
            'title' => 'required',
            'author' => 'required'
        ]);

        Book::create($data);
    }

    public function update(Book $book)
    {
        $data = $this->validate(\request(), [
            'title' => 'required',
            'author' => 'required'
        ]);

        $book->update($data);
    }
}
