<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Repositories\ClientesRepository;

class DetailsClientes extends Component
{
    private ?object $clientesRepository = NULL;
    public string $idCliente = "";

    private ?object $detailsClientes = NULL;

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    
    public function mount($cliente)
    {
        $this->idCliente = $cliente;
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($cliente);
    }
    
    public function render()
    {
        return view('livewire.clientes.details-clientes',["detalhesCliente" => $this->detailsClientes]);
    }
}
