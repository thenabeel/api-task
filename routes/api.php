<?php

use Illuminate\Http\Request;

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

Route::group(
    [
        'namespace' => 'Api',
        'middleware' => 'apienforcejson'
    ],
    function () {
        Route::get('/external-books', 'ExternalBooksController');
    }
);

Route::group(
    [
        'namespace' => 'Api\\v1',
        'prefix' => 'v1',
        'middleware' => 'apienforcejson'
    ],
    function () {
        Route::post('/books', 'BooksController@store');
        Route::get('/books', 'BooksController@index');
        Route::patch('/books/{id}', 'BooksController@update');
        Route::delete('/books/{id}', 'BooksController@destroy');
        Route::get('/books/{id}', 'BooksController@show');
    }
);
