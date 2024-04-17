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
                    <h2>Create New Author</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('authors.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth:</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Author</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
