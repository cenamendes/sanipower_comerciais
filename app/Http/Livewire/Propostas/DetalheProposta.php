<?php

namespace App\Http\Livewire\Propostas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use App\Interfaces\PropostasInterface;
use Livewire\WithPagination;

class DetalheProposta extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    private ?object $propostasRepository =  NULL;

    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $detailsClientes = NULL;
    private ?object $getCategories = NULL;
    private ?object $getCategoriesAll = NULL;
    private ?object $products = NULL;
    public ?string $searchTextCategory = "";
    public bool $filter;
    public bool $familyInfo = false;
    public bool $showLoaderPrincipal = true;

    public string $tabDetail = "";
    public string $tabProdutos = "show active";
    public string $tabDetalhesPropostas = "";
    public string $tabDetalhesCampanhas = "";
    protected $listeners=["rechargeFamilys" => "rechargeFamilys"];

    public int $specificProduct = 0;
    public int $idFamilyInfo = 0;

    public int $perPage = 10;

    public function boot(ClientesInterface $clientesRepository, PropostasInterface $propostasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->propostasRepository = $propostasRepository;
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

        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();
        // $this->products = $this->propostasRepository->getProdutosRandom();

        $this->showLoaderPrincipal = true;
    }
    public function rechargeFamilys($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();

        $this->familyInfo = false;
        $this->dispatchBrowserEvent('refreshComponent',["id" => $id]);
    }
    public function openDetailProduto($id)
    {
        $this->specificProduct = 1;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabDetalhesCampanhas = "";

        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();

        $this->filter = false;
    }

    public function recuarLista($id)
    {
        $this->specificProduct = 0;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabDetalhesCampanhas = "";

        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();

        return redirect()->route('propostas.detail', ['id' => $this->idCliente]);
    }

    public function adicionarProduto($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabDetalhesCampanhas = "";

        $this->specificProduct = 0;

        $this->dispatchBrowserEvent('compraRapida');
    }

    public function verEncomenda()
    {
        //TENHO DE ASSOCIAR Á AO USER E AO CLIENTE

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabDetalhesCampanhas = "";
        
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();
        $this->dispatchBrowserEvent('encomendaAtual');
    }


    public function searchCategory($idCategory,$idFamily)
    {
            $this->getCategoriesAll = $this->propostasRepository->getCategorias();  
            
            $this->getCategories = $this->propostasRepository->getCategoriasSearched($this->getCategoriesAll->category[$idCategory - 1]->id,$idFamily);
            $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
            
            
            $this->tabDetail = "";
            $this->tabProdutos = "show active";
            $this->tabDetalhesPropostas = "";
            $this->tabDetalhesCampanhas = "";

            $this->filter = true;
            $this->familyInfo = true;
            $this->idFamilyInfo = $idFamily;


            $this->showLoaderPrincipal = false;

            $this->specificProduct = 0;

            $this->dispatchBrowserEvent('refreshComponent',["id" => $idCategory]);
    }

    public function resetFilter($idCategory)
    {
        $this->getCategories = $this->propostasRepository->getCategorias();
        $this->getCategoriesAll = $this->propostasRepository->getCategorias();
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->familyInfo = false;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabDetalhesCampanhas = "";

        $this->specificProduct = 0;

        $this->showLoaderPrincipal = false;

        $this->dispatchBrowserEvent('refreshComponent',["id" => $this->getCategoriesAll->category[$idCategory - 1]->id]);
    }


    public function render()
    {
        return view('livewire.propostas.detalhe-proposta',["detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll]);
    }
}
