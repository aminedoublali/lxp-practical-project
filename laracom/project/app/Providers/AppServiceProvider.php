<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Laravel\Cashier\Cashier;
use App\Repositories\Interfaces\EvaluationRepositoryInterface;
use App\Repositories\EvaluationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cashier::useCurrency(config('cart.currency'), config('cart.currency_symbol'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EvaluationRepositoryInterface::class, 
            EvaluationRepository::class
        );
    }
}
