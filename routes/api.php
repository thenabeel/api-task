<?php


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
        'middleware' => 'apienforcejson',
    ],
    function () {
        Route::group(
            [
                'namespace' => 'Api',
            ],
            function () {
                Route::get('/external-books', 'ExternalBooksController');
            }
        );

        Route::group(
            [
                'namespace' => 'Api\\v1',
                'prefix' => 'v1',
            ],
            function () {
                Route::get('/books', 'BooksController@index');
                Route::post('/books', 'BooksController@store');
                Route::get('/books/{id}', 'BooksController@show');
                Route::patch('/books/{id}', 'BooksController@update');
                Route::delete('/books/{id}', 'BooksController@destroy');
            }
        );
    }
);
