<?php

namespace App\Repositories;

use App\Book;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Api\Books\Read;
use App\Http\Requests\Api\Books\Show;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Books\ShowBook;
use App\Http\Requests\Api\Books\Create;
use App\Http\Requests\Api\Books\Delete;
use App\Http\Requests\Api\Books\Update;
use App\Http\Resources\Books\CreateBook;
use App\Http\Resources\Books\DeleteBook;
use App\Http\Resources\Books\UpdateBook;
use App\Http\Resources\Books\BookCollection;

class BookRepository
{
    /**
     * @param Create $request
     * @return CreateBook
     */
    public function create(Create $request): CreateBook
    {
        $book = Book::create($request->validated());

        return new CreateBook($book);
    }

    /**
     * @param Read $request
     * @return BookCollection
     */
    public function read(Read $request): BookCollection
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
    public function update(Update $request, $id): UpdateBook
    {
        $data = $request->validated();
        unset($data['id']);

        /** @var Book $book */
        $book = Book::find($id);
        $oldBookName = $book->name;

        $book->update($data);

        return new UpdateBook($book, $oldBookName);
    }

    /**
     * @param Delete $delete
     * @param $id
     * @return DeleteBook
     */
    public function delete(Delete $delete, $id): DeleteBook
    {
        try {
            /** @var Book $book */
            $book = Book::find($id);
            $oldBookName = $book->name;

            $book->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting record', [
                'id' => $id,
            ]);
        }

        return new DeleteBook($book, $oldBookName);
    }

    /**
     * @param Show $request
     * @param $id
     * @return ShowBook
     */
    public function show(Show $request, $id): ShowBook
    {
        $book = Book::find($id);

        return new ShowBook($book);
    }
}
