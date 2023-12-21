@extends('books.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Search Results</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('books.index') }}">Back</a>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>@sortablelink('title', 'Title')</th>
        <th>@sortablelink('author', 'Author')</th>
    </tr>
</thead>
<tbody>
    @foreach ($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
