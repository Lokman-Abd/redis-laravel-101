<?php

namespace App\Http;

use stdClass;
use Predis\Client;

trait GeneralTrait {

    public function get_authors($client)
    {
        $authors_data = $client->hgetall("authors");
      
        $authors_ids = array_keys($authors_data);
        $authors = [];
        foreach ($authors_ids as  $id) {
            $author_data = $client->lrange("authors_list:" . $id, 0, -1);
            
            if (!$author_data) {
                continue;
            }
            $author = new stdClass();
            $author->id = $id;
            $author->first_name = $author_data[0];
            $author->last_name = $author_data[1];
            $author->date_of_birth = $author_data[2];
            $author->city = $author_data[3];
            // Add the author object to the array of authors
            $authors[] = $author;
        }
        return $authors;
    }

    public function get_books($client)
    {

        $books_data = $client->hgetall("books");
        $books_ids = array_keys($books_data);
        $books = [];
        foreach ($books_ids as  $id) {
            $book_data = $client->lrange("books_list:" . $id, 0, -1);
            if (!$book_data) {
                continue;
            }
            $book = new stdClass();
            $book->id = $id;
            $book->author_id = $book_data[0];
            $book->title = $book_data[1];
            $book->publish_date = $book_data[2];
            $book->rate = $book_data[3];
            $book->language = $book_data[4];
            $book->description = $book_data[5];
            // Add the book object to the array of books
            $books[] = $book;
        }
        return $books;
    }
    public function get_author_full_name($id){
        $client=new Client();
        $author_data = $client->lrange("authors_list:" . $id, 0, -1);
   
        return $author_data[0]." ".$author_data[1];
    }
    public function asign_book_author($books){
        foreach ($books as $book) {
            $book->author_full_name= $this->get_author_full_name($book->author_id);
        }
        return $books;
    }
    public function get_next_id($table)
    {
        $client = new Client();
        $data = $client->hgetall($table);
        if(!$data){ 
            return "id0";
        }
        $keys = array_keys($data);
        sort($keys);
        // Extract the number using regular expression
        preg_match('/\d+/', end($keys), $matches);
        return('id'.$matches[0]+1);
    }

    public function convert_into_object($array)
    {
        $objects = [];
        foreach ($array as $item) {
            $object = new stdClass();
            foreach ($item as $key => $value) {
                $object->$key = $value;
            }
            $objects[] = $object;
        }
        return $objects;
    }

}