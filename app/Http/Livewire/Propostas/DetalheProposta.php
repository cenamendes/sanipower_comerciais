<?php

namespace App\Http\Livewire\Propostas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;

class DetalheProposta extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $detailsClientes = NULL;

    public string $tabDetail = "show active";
    public string $tabProdutos = "";
    public string $tabDetalhesProposta = "";

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }

    private function initProperties(): void
    {
       
    }

    public function mount($cliente)
    {
        $this->initProperties();
        $this->idCliente = $cliente;
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

    }


    public function render()
    {
        return view('livewire.propostas.detalhe-proposta',["detalhesCliente" => $this->detailsClientes]);
    }
}
