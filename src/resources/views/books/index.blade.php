@extends('books.layout')
@section('content')


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2>Add New Book</h2>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Author:</strong>
                <input type="text" name="author" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>

<form action="{{ route('books.search') }}" method="GET">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Search by Title or Author:</strong>
                <input type="search" name="search_book" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<br>
<br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('author', 'Author')</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit Author</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>

    </table>
    {{ $books->links() }}


   
    <h2>Export table to CSV or XML</h2>
    <div id="export-container">
        <form action="{{ route('books.exportCSV') }}" method="POST">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong for="export-option-csv">CSV:</strong>
                <select name="export-option-csv" id="export-option-csv">
                    <option value="books-csv">Books.csv</option>
                    <option value="titles-csv">Titles.csv</option>
                    <option value="authors-csv">Authors.csv</option>
                </select>
                <button type="submit" class="btn btn-primary">Download</button>
            </div>
        </form>
        <br>
        <br>
        <form action="{{ route('books.exportXML') }}" method="POST">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong for="export-option-xml">XML:</strong>
                <select name="export-option-xml" id="export-option-xml">
                    <option value="books-xml">Books.xml</option>
                    <option value="titles-xml">Titles.xml</option>
                    <option value="authors-xml">Authors.xml</option>
                </select>
                <button type="submit" class="btn btn-primary">Download</button>
            </div>
        </form>
    </div>

@endsection