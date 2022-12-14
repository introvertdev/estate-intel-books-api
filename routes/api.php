<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\ExternalBookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* The search  is done through query string.
    By identifying key parameter you are search for and using it as a get request key

    e.g  To search by name of a book
    127.0.0.1:8080/api/v1/books/search?name=book name
    ******************OR*****************************
    Search by country name
    127.0.0.1:8080/api/vi/books/search?country=USA

    For external search, 
    127.0.0.1:8080/api/v1/external-books/search?name=book name
    */

Route::group(['namespace' => 'Api\V1'], function () {
    Route::get('external-books', [ExternalBookController::class, 'externalSearch']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    Route::get('books/search', [BookController::class, 'search']);

    Route::get('/books', [BookController::class, 'index']);
    Route::post('books', [BookController::class, 'store']);
    Route::get('books/{id}', [BookController::class, 'show']);
    Route::put('books/{id}', [BookController::class, 'update']);
    Route::patch('books/{id}', [BookController::class, 'update']);
    Route::delete('books/{id}', [BookController::class, 'destroy']);
});