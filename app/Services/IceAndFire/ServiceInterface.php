<?php

namespace App\Services\IceAndFire;

use GuzzleHttp\Client;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ServiceInterface
{
    public function __construct(Client $client, array $params = []);
    public function getData(): ResourceCollection;
}
