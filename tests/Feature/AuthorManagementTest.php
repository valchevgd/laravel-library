<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'New Author',
            'dob' => '05/06/1986'
        ]);

        $this->assertCount(1, Author::all());

        $author = Author::first();

        $this->assertInstanceOf(Carbon::class, $author->dob);
        $this->assertEquals('1986/06/05', $author->dob->format('Y/d/m'));
    }
}
