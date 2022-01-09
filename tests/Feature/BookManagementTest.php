<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'A New Book',
            'author' => 'New Author'
        ]);

        $this->assertCount(1, Book::all());
        $response->assertRedirect(Book::first()->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => null,
            'author' => 'New Author'
        ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'A New Book',
            'author' => null
        ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'A New Book',
            'author' => 'New Author'
        ]);

        $book = Book::first();
        $new_title = 'Updated Title';
        $new_author = 'Updated Author';

        $response = $this->patch('/books/' . $book->id, [
            'title' => $new_title,
            'author' => $new_author
        ]);

        $book = $book->fresh();

        $this->assertEquals($new_title, $book->title);
        $this->assertEquals($new_author, $book->author);

        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'A New Book',
            'author' => 'New Author'
        ]);

        $this->assertCount(1, Book::all());

        $book = Book::first();

        $response = $this->delete('/books/' . $book->id);

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }
}
