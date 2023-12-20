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
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>
            <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </td>
    </tr>
    @endforeach
</tbody>

</table>





@endsection