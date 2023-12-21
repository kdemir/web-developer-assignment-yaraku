<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Book;

class BookController extends Controller
{
    
    //show all existing books from the database
    public function index()
    {
        $books = Book::sortable()->paginate(10);
        return view('books.index', compact('books'))->with(request()->input('page'));
    }


    //add new book to the database
    public function store(Request $request)
    {
      //validate the user input
      $request->validate([
        'title' => 'required',
        'author' => 'required'
    ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'New Book has been added');

    }
  

    //open view for editing Author
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    
    //edit Authors name
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'author' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success','Author updated successfully');
    }
    

    //delete existing book
    public function destroy($id)
    {
      $book = Book::findOrFail($id);
      $book->delete();
      return redirect()->route('books.index')->with('success','Book deleted successfully');
   
    }


    //search function: input string searches in Title and Author
    //redirecting to a new view with search results
    public function search()
    {
        $search_text = $_GET['search_book'];
        $books = Book::where('title', 'LIKE', '%'.$search_text.'%')->orwhere('author', 'LIKE', '%'.$search_text.'%')->get();

        return view('books.search', compact('books'));
    }


    //generates csv content for csv export
    private function generateCsvContent($data)
    {
        $file = fopen('php://temp', 'w');
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        rewind($file);
        $content = stream_get_contents($file);
        fclose($file);
        return $content;
    }


    //method for exporting csv 
    //user can choose betweend books, titles and authors
    public function exportToCsv(Request $request)
    {
        $books = Book::all();
        $exportOption = $request->input('export-option-csv');

        $filename = '';
        $csvData = [];
        $columns = [];

        if ($exportOption === 'titles-csv') {
            $filename = 'book-titles.csv';
            $columns = ['Title'];
            foreach ($books as $book) {
                $csvData[] = [$book->title];
            }
        } elseif ($exportOption === 'authors-csv') {
            $filename = 'book-authors.csv';
            $columns = ['Author'];
            foreach ($books as $book) {
                $csvData[] = [$book->author];
            }
        } elseif ($exportOption === 'books-csv') {
            $filename = 'books.csv';
            $columns = ['Title', 'Author'];
            foreach ($books as $book) {
                $csvData[] = [$book->title, $book->author];
            }
        } 

        array_unshift($csvData, $columns);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $content = $this->generateCsvContent($csvData);

        return Response::make($content, 200, $headers);

    }


    //method for exporting XML 
    //user can choose betweend books, titles and authors
    public function exportToXml(Request $request)
    {
        $exportOption = $request->input('export-option-xml');
        $books = Book::all();

        if ($exportOption === 'books-xml') {
            $booksXmlData = new \SimpleXMLElement('<books></books>');
            foreach ($books as $book) {
                $bookElement = $booksXmlData->addChild('book');
                $bookElement->addChild('title', $book->title);
                $bookElement->addChild('author', $book->author);
            }
            $xmlContent = $booksXmlData->asXML();
            $headers = [
                'Content-Type' => 'application/xml',
                'Content-Disposition' => 'attachment; filename=books.xml',
            ];

        } else if ($exportOption === 'titles-xml') {
            $titlesXmlData = new \SimpleXMLElement('<titles></titles>');
            foreach ($books as $book) {
                $titleElement = $titlesXmlData->addChild('title', $book->title);
            }
            $xmlContent = $titlesXmlData->asXML();
            $headers = [
                'Content-Type' => 'application/xml',
                'Content-Disposition' => 'attachment; filename=titles.xml',
            ];

        } else if ($exportOption === 'authors-xml') {
            $authorsXmlData = new \SimpleXMLElement('<authors></authors>');
            foreach ($books as $book) {
                $authorElement = $authorsXmlData->addChild('author', $book->author);
            }
            $xmlContent = $authorsXmlData->asXML();
            $headers = [
                'Content-Type' => 'application/xml',
                'Content-Disposition' => 'attachment; filename=authors.xml',
            ];
        }

        return Response::make($xmlContent, 200, $headers);
    }

}