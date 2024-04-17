<?php

use Predis\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (){
    return redirect()->route('authors.index');
})->name("home");
// Route::get('/create-author', [AuthorController::class,'create']);
Route::resource('authors', AuthorController::class)->only([
    'index', 'create','store'
]);
Route::resource('books', BookController::class)->only([
    'create','store'
]);