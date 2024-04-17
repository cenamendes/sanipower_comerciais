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

    public int $specificProduct = 0;

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }

    public function mount($cliente)
    {
        $this->idCliente = $cliente;
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->specificProduct = 0;

    }

    public function openDetailProduto($id)
    {
        $this->specificProduct = 1;
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesProposta = "";
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
    }

    public function recuarLista($id)
    {
        $this->specificProduct = 0;
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesProposta = "";
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
    }

    public function adicionarProduto($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesProposta = "";

        $this->dispatchBrowserEvent('compraRapida');
    }

    public function verEncomenda()
    {
        //TENHO DE ASSOCIAR Á AO USER E AO CLIENTE

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesProposta = "";
        
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->dispatchBrowserEvent('encomendaAtual');
    }


    public function render()
    {
        return view('livewire.propostas.detalhe-proposta',["detalhesCliente" => $this->detailsClientes]);
    }
}
