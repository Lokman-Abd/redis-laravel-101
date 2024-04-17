<?php

namespace App\Http\Controllers;

use App\Http\GeneralTrait;
use stdClass;
use Predis\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    use GeneralTrait;
    public function create()
    {
        $client = new Client();
        $authors = $this->convert_into_object($this->get_authors($client));
        return view('books.create', compact(["authors"]));
    }

    public function store(Request $request)
    {
          // Validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author_id' => 'required',
            'publish_date' => 'required|date',
            'rate' => 'required|numeric|min:0|max:10',
            'language' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $next_id = $this->get_next_id("books");
        $client = new Client();
        $client->hset("books", $next_id, $request->title);
        // Push new values into the list
        $client->rpush("books_list:" . $next_id,array_values($request->only(['author_id', 'title', 'publish_date', 'rate', 'language', 'description']))
        );

        return redirect()->back()->with('success', 'Book created successfully!');
    }
}
