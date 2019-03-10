<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\IceAndFire\IceAndFire;
use App\Http\Requests\Api\ExternalBooksFormRequest;

class ExternalBooksController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ExternalBooksFormRequest $request
     * @param IceAndFire $iceAndFire
     * @return \App\Http\Resources\ExternalBooksCollection
     */
    public function __invoke(ExternalBooksFormRequest $request, IceAndFire $iceAndFire)
    {
        return $iceAndFire->getBooks($request->validated()['name']);
    }
}
