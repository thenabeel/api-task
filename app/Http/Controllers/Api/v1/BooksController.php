<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Http\Requests\Api\Books\Read;
use App\Http\Requests\Api\Books\Show;
use App\Http\Requests\Api\Books\Create;
use App\Http\Requests\Api\Books\Delete;
use App\Http\Requests\Api\Books\Update;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BooksController extends Controller
{
    /** @var BookRepository $repository */
    protected $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Read $request
     * @return ResourceCollection
     */
    public function index(Read $request): ResourceCollection
    {
        return (new $this->repository)->read($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Create $request
     * @return JsonResource
     */
    public function store(Create $request): JsonResource
    {
        return (new $this->repository)->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Show $request
     * @param int $id
     * @return JsonResource
     */
    public function show(Show $request, $id): JsonResource
    {
        return (new $this->repository)->show($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Update $request
     * @param int $id
     * @return JsonResource
     */
    public function update(Update $request, $id): JsonResource
    {
        return (new $this->repository)->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Delete $request
     * @param int $id
     * @return JsonResource
     */
    public function destroy(Delete $request, $id): JsonResource
    {
        return (new $this->repository)->delete($request, $id);
    }
}
