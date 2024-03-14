<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Repositories\ClientesRepository;

class DetailsClientes extends Component
{
    private ?object $clientesRepository = NULL;

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    
    public function mount()
    {

    }
    
    public function render()
    {
        return view('livewire.clientes.details-clientes');
    }
}
