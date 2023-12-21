<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class AddBookTest extends TestCase
{
   
    use RefreshDatabase;
    public function testAddBook()
    {
        $this->withoutMiddleware();
        $initialBookCount = Book::count();
        $book = [
            'title' => 'Test Title',
            'author' => 'Test Author',
        ];

        $response = $this->post(route('books.store'), $book);
        $this->assertDatabaseHas('books', $book);
        $this->assertEquals($initialBookCount + 1, Book::count());
        $response->assertRedirect(route('books.index'));
    }
}
