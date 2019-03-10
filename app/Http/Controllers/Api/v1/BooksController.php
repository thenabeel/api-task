<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Http\Requests\Api\Books\Read;
use App\Http\Requests\Api\Books\Show;
use App\Http\Requests\Api\Books\Create;
use App\Http\Requests\Api\Books\Delete;
use App\Http\Requests\Api\Books\Update;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Books\BookCollection
     */
    public function index(Read $request)
    {
        return (new BookRepository)->read($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Books\Book
     */
    public function store(Create $request)
    {
        return (new BookRepository)->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Show $request
     * @param int $id
     * @return \App\Http\Resources\Books\Book
     */
    public function show(Show $request, $id)
    {
        return (new BookRepository)->show($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Update $request
     * @param  int $id
     * @return \App\Http\Resources\Books\UpdateBook
     */
    public function update(Update $request, $id)
    {
        return (new BookRepository)->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Delete $request
     * @param  int $id
     * @return \App\Http\Resources\Books\DeleteBook
     */
    public function destroy(Delete $request, $id)
    {
        return (new BookRepository)->delete($request, $id);
    }
}
