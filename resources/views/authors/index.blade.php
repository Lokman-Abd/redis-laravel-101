@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h2>Authors List</h2>
                    <a href="{{route('authors.create')}}" class="btn btn-success">New Author</a>
                </div>
                <div class="card-body">
                    <h4>Authors</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->first_name }}</td>
                                <td>{{ $author->last_name }}</td>
                                <td>{{ $author->date_of_birth }}</td>
                                <td>{{ $author->city }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h2>Books List</h2>
                    <a href="{{route('books.create')}}" class="btn btn-success">New Books</a>
                </div>
                <div class="card-body">
                    <h4>Books</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author Full name</th>
                                <th>Publish Date</th>
                                <th>Rate</th>
                                <th>Language</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author_full_name }}</td>
                                <td>{{ $book->publish_date }}</td>
                                <td>{{ $book->rate }}</td>
                                <td>{{ $book->language }}</td>
                                <td>{{ $book->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection