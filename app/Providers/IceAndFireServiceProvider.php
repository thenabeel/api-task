<?php

namespace App\Providers;

use GuzzleHttp\Client;
use App\Services\IceAndFire\IceAndFireFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class IceAndFireServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IceAndFireFactory::class, function () {
            $client = new Client([
                'base_uri' => 'https://www.anapioficeandfire.com/api/',
            ]);

            return new IceAndFireFactory($client);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [IceAndFireFactory::class];
    }
}
