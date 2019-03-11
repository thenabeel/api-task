<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\IceAndFire\IceAndFireFactory;
use App\Http\Requests\Api\ExternalBooksFormRequest;

class ExternalBooksController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ExternalBooksFormRequest $request
     * @param IceAndFireFactory $iceAndFire
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     * @throws \Exception
     */
    public function __invoke(ExternalBooksFormRequest $request, IceAndFireFactory $iceAndFire)
    {
        return $iceAndFire->getData('books', [
            'name' => $request->validated()['name']
        ]);
    }
}
