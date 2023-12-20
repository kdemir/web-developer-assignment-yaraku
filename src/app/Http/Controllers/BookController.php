<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    
    public function index()
    {
        //show all the books from database
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books'))->with(request()->input('page'));
        
    }


    public function create()
    {
    
    }


    public function store(Request $request)
    {
      //validate the user input
      $request->validate([
        'title' => 'required',
        'author' => 'required'
    ]);

        //creates a new book in the database
        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'New Book has been added');

    }

 
    public function show(Book $book)
    {
        
    }

  
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'author' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success','Author updated successfully');
    }
    


    public function destroy($id)
    {
      //delete existing book
      $book = Book::findOrFail($id);
      $book->delete();
      return redirect()->route('books.index')->with('success','Book deleted successfully');
   
    }

}
