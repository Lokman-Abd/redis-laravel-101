<?php

namespace App\Http\Controllers;

use App\Http\GeneralTrait;
use stdClass;
use Predis\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $client = new Client();
        $authors = $this->get_authors($client);
        $books = $this->get_books($client);
        $books=$this->asign_book_author($books);
        return view('authors.index', compact(["authors", "books"]));
    }


    public function create()
    {
        return view('authors.create');
    }
   
    public function store(Request $request)
    {
          // Validate the form data
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'city' => 'required|string|max:255',
    ]);

    // If validation fails, redirect back with errors
    if ($validator->fails()) {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
    }
        $next_id=$this->get_next_id("authors");
        $client = new Client();
        $client->hset("authors", $next_id, $request->first_name);
        //     // Push new values into the list
        $client->rpush("authors_list:".$next_id, 
        array_values($request->only(['first_name','last_name','date_of_birth',"city"]))
        );

        return redirect()->back()->with('success', 'Book created successfully!');;
    }



}
