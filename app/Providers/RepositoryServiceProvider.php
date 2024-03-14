<?php

namespace App\Providers;

use App\Interfaces\ClientesInterface;
use App\Repositories\ClientesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ClientesInterface::class => ClientesRepository::class,
       
    ];
}
