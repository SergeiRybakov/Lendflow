<?php

namespace App\Providers;

use App\Repositories\NewYorkTimes\NewYorkTimesBookApiRepository;
use App\Repositories\NewYorkTimes\NewYorkTimesBookRepositoryInterface;
use App\Services\NewYorkTimesApiService;
use App\Hydrators\Common\Hydrator;
use Illuminate\Support\ServiceProvider;

class NewYorkTimesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Hydrator::class);

        $this->app->singleton(NewYorkTimesApiService::class, function () {
            return new NewYorkTimesApiService(
                config('services.nyt.apiUrl'),
                config('services.nyt.apiKey'),
                $this->app->get(Hydrator::class)
            );
        });



        $this->app->bind(
            NewYorkTimesBookRepositoryInterface::class,
            NewYorkTimesBookApiRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
