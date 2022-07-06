<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MeiliSearch\Client;

class ScoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $client = new Client('http://meilisearch:7700');
        $client->index('properties')->updateFilterableAttributes(['rentOrSale', 'type', 'price', 'category', 'area', 'zip_code', 'city']);

    }
}
