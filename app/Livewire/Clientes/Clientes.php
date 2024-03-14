<?php

namespace App\Livewire\Clientes;

use App\Models\User;
use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Repositories\ClientesRepository;

class Clientes extends Component
{
    private ?object $clientesRepository = NULL;
    public ?object $clientes = NULL;

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }

    public function mount()
    {
        $this->clientes = $this->clientesRepository->getListagemClientes();
        
    }
    
    public function render()
    {
        return view('livewire.clientes.clientes',["clientes" => $this->clientes]);
    }
}
