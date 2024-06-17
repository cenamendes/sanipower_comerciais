<?php

namespace App\Providers;

use App\Services\OfficeService;
use App\View\Components\AppLayout;
use App\Interfaces\VisitasInterface;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Blade;
use App\Interfaces\PropostasInterface;
use App\Interfaces\EncomendasInterface;
use App\Interfaces\TarefasInterface;
use App\Repositories\VisitasRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ClientesRepository;
use App\Repositories\PropostasRepository;
use App\Repositories\EncomendasRepository;
use App\Repositories\TarefasRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientesInterface::class, ClientesRepository::class);
        $this->app->bind(EncomendasInterface::class, EncomendasRepository::class);
        $this->app->bind(PropostasInterface::class, PropostasRepository::class);
        $this->app->bind(VisitasInterface::class, VisitasRepository::class);
        $this->app->bind(TarefasInterface::class, TarefasRepository::class);
        $this->app->singleton(OfficeService::class, function ($app) {
            return new OfficeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('app-layout', AppLayout::class);
    }
}
