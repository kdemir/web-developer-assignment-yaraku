<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class DeleteBookTest extends TestCase
{
    use DatabaseMigrations;
    public function testDeleteBook()
    {
        $book = Book::create([
            'id' => '100',
            'title' => 'Test Title',
            'author' => 'Test Author',
        ]);

        $initialBookCount = Book::count();
        $response = $this->delete(route('books.destroy', $book, ['id' => '100']));
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
        $this->assertEquals($initialBookCount - 1, Book::count());
        $response->assertRedirect(route('books.index'));

    }
}
