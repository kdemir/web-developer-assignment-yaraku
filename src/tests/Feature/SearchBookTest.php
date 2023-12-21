<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class SearchBookTest extends TestCase
{
   
    use RefreshDatabase;

    public function testSearchBook()
    {
        $data = [
            'title' => 'Test Title',
            'author' => 'Test Author',
        ];
        $book = Book::create($data);

        $search_text = 'Test';

        $response = $this->get(route('books.search', $search_text), [
            'author' => $book->author, 
            'title' => $book->title
        ])->assertSee($book->author, $book->title);

        
    }
}