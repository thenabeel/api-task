<?php

namespace App\Repositories;

use App\Book;
use App\Http\Requests\Api\Books\Create;
use App\Http\Requests\Api\Books\Delete;
use App\Http\Requests\Api\Books\Read;
use App\Http\Requests\Api\Books\Show;
use App\Http\Requests\Api\Books\Update;
use App\Http\Resources\Books\Book as BookResource;
use App\Http\Resources\Books\BookCollection;
use App\Http\Resources\Books\DeleteBook;
use App\Http\Resources\Books\Show as ShowResource;
use App\Http\Resources\Books\UpdateBook;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class BookRepository
{
    /**
     * @param Create $request
     * @return BookResource
     */
    public function create(Create $request)
    {
        $data = $request->validated();

        $book = Book::create($data);

        return new BookResource($book);
    }

    public function read(Read $request)
    {
        $books = QueryBuilder::for(Book::class)
            ->allowedFilters([
                'name',
                'country',
                'publisher',
                Filter::scope('release_year'),
            ])
            ->get();

        return new BookCollection($books);
    }

    /**
     * @param Update $request
     * @param $id
     * @return UpdateBook
     */
    public function update(Update $request, $id)
    {
        $data = $request->validated();
        unset($data['id']);

        /** @var Book $book */
        $book = Book::find($id);
        $oldBookName = $book->name;

        $book->update($data);

        return new UpdateBook($book, $oldBookName);
    }

    public function delete(Delete $delete, $id)
    {
        try {
            /** @var Book $book */
            $book = Book::find($id);
            $oldBookName = $book->name;

            $book->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting record', [
                'id' => $id
            ]);
        }

        return (new DeleteBook($book, $oldBookName));
    }

    public function show(Show $request, $id)
    {
        $book = Book::find($id);

        return new ShowResource($book);
    }
}
