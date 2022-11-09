<?php

namespace App\Providers;

use App\Http\Repository\FileRepository;
use App\Http\Repository\Interfaces\FileInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FilemanagerServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind(
            FileInterface::class,
            FileRepository::class
        );
    }

    /**
     * Register config.
     *
     * @return void
     */


    /**
     * Register views.
     *
     * @return void
     */


    /**
     * Register translations.
     *
     * @return void
     */


    /**
     * Register an additional directory of factories.
     *
     * @return void
     */


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }


}
