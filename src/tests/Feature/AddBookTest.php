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
        $data = [
            'title' => 'Test Title',
            'author' => 'Test Author',
        ];

        $response = $this->post(route('books.store'), $data);
        $this->assertDatabaseHas('books', $data);
        $this->assertEquals($initialBookCount + 1, Book::count());
        $response->assertRedirect(route('books.index'));
    }
}
