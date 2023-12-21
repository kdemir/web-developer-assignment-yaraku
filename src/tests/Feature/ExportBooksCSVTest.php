<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class ExportBooksCSVTest extends TestCase
{
    use DatabaseMigrations;
    protected function createBooks()
    {
        $book1 = Book::create(['title' => 'Test Book 1', 'author' => 'Test Author 1']);
        $book2 = Book::create(['title' => 'Test Book 2', 'author' => 'Test Author 2']);
        $book3 = Book::create(['title' => 'Test Book 3', 'author' => 'Test Author 3']);
    }

    public function testExportBooksCSV()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportCSV'), ['export-option-csv' => 'books-csv']);
        $this->assertTrue(preg_match('/^text\/csv/', $response->headers->get('Content-Type')) === 1);
    }

    public function testExportTitlesCSV()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportCSV'), ['export-option-csv' => 'titles-csv']);
        $this->assertTrue(preg_match('/^text\/csv/', $response->headers->get('Content-Type')) === 1);
    }

    public function testExportAuthorsCSV()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportCSV'), ['export-option-csv' => 'authors-csv']);
        $this->assertTrue(preg_match('/^text\/csv/', $response->headers->get('Content-Type')) === 1);

    }
}