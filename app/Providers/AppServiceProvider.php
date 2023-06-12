<?php

namespace App\Providers;

use App\Http\Requests\TicketRequest;
use App\Services\Ticket\TicketServiceDefault;
use App\Services\Ticket\TicketServiceInterface;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $request = $this->app->get(Request::class);

        $this->app->singleton(
            TicketServiceInterface::class,
            function(Application $application) use ($request) {
                if ($request->has('tariff')) {
                    throw new \LogicException('Tariff\'s is not supported yet');
                }

                return $application->get(TicketServiceDefault::class);
            },
        );
    }
}
