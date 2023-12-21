<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Book;

class ExportBooksXMLTest extends TestCase
{
    use DatabaseMigrations;
    protected function createBooks()
    {
        $book1 = Book::create(['title' => 'Test Book 1', 'author' => 'Test Author 1']);
        $book2 = Book::create(['title' => 'Test Book 2', 'author' => 'Test Author 2']);
        $book3 = Book::create(['title' => 'Test Book 3', 'author' => 'Test Author 3']);
    }

    public function testExportBooksXML()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportXML'), ['export-option-xml' => 'books-xml']);
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function testExportTitlesXML()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportXML'), ['export-option-xml' => 'titles-xml']);
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function testExportAuthorsXML()
    {
        $this->withoutMiddleware();
        $this->createBooks();

        $response = $this->post(route('books.exportXML'), ['export-option-xml' => 'authors-xml']);
        $response->assertHeader('Content-Type', 'application/xml');
    }

}