<?php

namespace App\Providers;

use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use App\Interfaces\PropostasInterface;
use App\Interfaces\VisitasInterface;
use App\Repositories\ClientesRepository;
use App\Repositories\EncomendasRepository;
use App\Repositories\PropostasRepository;
use App\Repositories\VisitasRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\AppLayout;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('app-layout', AppLayout::class);
    }
}
