<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use Livewire\WithPagination;

class DetalheEncomenda extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    private ?object $encomendasRepository =  NULL;

    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $detailsClientes = NULL;
    private ?object $getCategories = NULL;
    private ?object $getCategoriesAll = NULL;
    private ?object $products = NULL;
    public ?string $searchTextCategory = "";
    public bool $filter;

    public string $tabDetail = "show active";
    public string $tabProdutos = "";
    public string $tabDetalhesEncomendas = "";

    public int $specificProduct = 0;

    public int $perPage = 10;

    public function boot(ClientesInterface $clientesRepository, EncomendasInterface $encomendasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->encomendasRepository = $encomendasRepository;
    }

    public function initProperties()
    {
        if (isset($this->perPage)) {
            session()->put('perPage', $this->perPage);
        } elseif (session('perPage')) {
            $this->perPage = session('perPage');
        } else {
            $this->perPage = 10;
        }
    }

    public function mount($cliente)
    {
        $this->initProperties();
        $this->idCliente = $cliente;
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->specificProduct = 0;
        $this->filter = false;

        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        // $this->products = $this->encomendasRepository->getProdutosRandom();
    }

    public function openDetailProduto($id)
    {
        $this->specificProduct = 1;
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->filter = false;
    }

    public function recuarLista($id)
    {
        $this->specificProduct = 0;
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
    
    }

    public function adicionarProduto($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";

        $this->dispatchBrowserEvent('compraRapida');
    }

    public function verEncomenda()
    {
        //TENHO DE ASSOCIAR Á AO USER E AO CLIENTE

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->dispatchBrowserEvent('encomendaAtual');
    }


    public function searchCategory($idCategory,$idFamily)
    {
            $this->getCategoriesAll = $this->encomendasRepository->getCategorias();  
            
            $this->getCategories = $this->encomendasRepository->getCategoriasSearched($this->getCategoriesAll->category[$idCategory - 1]->id,$idFamily);
            $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
            
            
            $this->tabDetail = "";
            $this->tabProdutos = "show active";
            $this->tabDetalhesEncomendas = "";

            $this->filter = true;

            $this->dispatchBrowserEvent('refreshComponent',["id" => $idCategory]);
    }

    public function resetFilter($idCategory)
    {
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->filter = false;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";

        $this->dispatchBrowserEvent('refreshComponent',["id" => $this->getCategoriesAll->category[$idCategory - 1]->id]);
    }


    public function render()
    {
        return view('livewire.encomendas.detalhe-encomenda',["detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll]);
    }
}
