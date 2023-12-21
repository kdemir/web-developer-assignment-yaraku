<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class UpdateBookTest extends TestCase
{
    use RefreshDatabase;
    public function testUpdateBook()
    {
        $data = [
            'title' => 'Test Title',
            'author' => 'Test Author',
        ];
        $book = Book::create($data);

        $newAuthor = 'Edited Author';

        $response = $this->put(route('books.update', $book), ['author' => $newAuthor]);
        $response->assertRedirect(route('books.index'));
        $book->refresh();
        $this->assertEquals($newAuthor, $book->author);
        
    }
}