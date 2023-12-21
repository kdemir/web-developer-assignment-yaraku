<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class DeleteBookTest extends TestCase
{
    use RefreshDatabase;
    public function testDeleteBook()
    {
        $data = Book::create([
            'id' => '100',
            'title' => 'Test Title',
            'author' => 'Test Author',
        ]);

        $initialBookCount = Book::count();
        $response = $this->delete(route('books.destroy', $data, ['id' => '100']));
        $this->assertDatabaseMissing('books', [
            'id' => $data->id,
        ]);
        $this->assertEquals($initialBookCount - 1, Book::count());
        $response->assertRedirect(route('books.index'));

    }
}
