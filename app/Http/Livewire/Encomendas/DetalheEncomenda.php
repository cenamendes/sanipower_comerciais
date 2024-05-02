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
    private ?object $searchSubFamily = NULL;
    private ?object $getCategories = NULL;
    private ?object $getCategoriesAll = NULL;
    private ?object $products = NULL;
    public ?string $searchTextCategory = "";
    public bool $filter;
    public bool $familyInfo = false;

    public bool $showLoaderPrincipal = true;

    public string $tabDetail = "";
    public string $tabProdutos = "show active";
    public string $tabDetalhesEncomendas = "";
    public string $tabDetalhesCampanhas = "";

    public int $specificProduct = 0;
    public string $idFamilyInfo = "";

    public int $perPage = 10;
    protected $listeners=["rechargeFamilys" => "rechargeFamilys"];

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

        $this->showLoaderPrincipal = true;
    }
    public function rechargeFamilys($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->familyInfo = false;
        $this->dispatchBrowserEvent('refreshComponent',["id" => $id]);
    }

    // public function openDetailProduto($idCategory, $idFamily, $idSubFamily, $idCustomer)
    public function openDetailProduto($id)
    {
        // dd($idCategory, $idFamily, $idSubFamily, $idCustomer);
        $this->specificProduct = 1;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        
 
        //tem que filtrar o produto aqui!
        // $this->searchFamilyProdutos = $this->encomendasRepository->getProdutos($idCategory, $idFamily, $idSubFamily, $idCustomer);  
        // dd($this->searchFamilyProdutos);
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->filter = false;
    }

    public function recuarLista($id)
    {
        $this->specificProduct = 0;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
     
        return redirect()->route('encomendas.detail', ['id' => $this->idCliente]);
    }

    public function adicionarProduto($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();


        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->specificProduct = 0;

        $this->dispatchBrowserEvent('compraRapida');
    }

    public function verEncomenda()
    {
        //TENHO DE ASSOCIAR Á AO USER E AO CLIENTE

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
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
            $this->tabDetalhesCampanhas = "";

            $this->filter = true;
            $this->familyInfo = true;
            $this->idFamilyInfo = $idFamily;

            $this->showLoaderPrincipal = false;

            $this->specificProduct = 0;

            $this->dispatchBrowserEvent('refreshComponent',["id" => $idCategory]);
    }
    public function searchSubFamily($idCategory, $idFamily, $idSubFamily)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->searchSubFamily = $this->encomendasRepository->getSubFamily($idCategory, $idFamily, $idSubFamily);  
        // dd($this->searchSubFamily);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->filter = true;
        $this->familyInfo = true;

        $this->idFamilyInfo = "";

        $this->showLoaderPrincipal = false;

        $this->specificProduct = 0;

        $this->dispatchBrowserEvent('refreshAllComponent');

    }
    
    public function resetFilter($idCategory)
    {
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->familyInfo = false;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->specificProduct = 0;

        $this->showLoaderPrincipal = false;

        $this->dispatchBrowserEvent('refreshComponent',["id" => $this->getCategoriesAll->category[$idCategory - 1]->id]);
    }
    public function render()
    {
        return view('livewire.encomendas.detalhe-encomenda',["detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll,'searchSubFamily' =>$this->searchSubFamily]);
    }
}
