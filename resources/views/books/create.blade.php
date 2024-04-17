<!-- create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Display validation errors if any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display success message if present -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Create New Book</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="publish_date">Publish Date:</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rate">Rate:</label>
                            <input type="number" name="rate" id="rate" class="form-control" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="language">Language:</label>
                            <input type="text" name="language" id="language" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author:</label>
                            <select name="author_id" id="author_id" class="form-control">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Add other fields for book details here -->
                        <button type="submit" class="btn btn-primary">Create Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
