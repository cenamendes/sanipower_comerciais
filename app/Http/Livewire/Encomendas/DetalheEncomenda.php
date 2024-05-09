<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use Illuminate\Support\Facades\Session;

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

    public string $idSubFamilyRecuar = "";
    public string $idFamilyRecuar = "";
    public string $idCategoryRecuar = "";
    public $iteration = 0;

    public ?string $searchProduct = "";
    public ?string $actualCategory = "";
    public ?string $actualFamily = "";
    public ?string $actualSubFamily = "";

    protected ?object $quickBuyProducts = NULL;
    public $iterationQuickBuy = 0;

    private ?object $detailProduto = NULL;

    public int $perPage = 10;
    protected $listeners=["rechargeFamily" => "rechargeFamily"];

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


        if(session('searchSubFamily') !== null)
        {
            $sessao = session('searchSubFamily');

            foreach($sessao->product as $prod)
            {
                $this->actualCategory = $prod->category_number;
                $this->actualFamily = $prod->family_number;
                $this->actualSubFamily = $prod->subfamily_number;

                break;
            }


            $this->searchSubFamily = $this->encomendasRepository->getSubFamily($this->actualCategory, $this->actualFamily, $this->actualSubFamily);  
        }



        if(session('searchProduct') !== null)
        {
            $this->searchProduct = session('searchProduct');

            if($this->searchProduct != "")
            {
                $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily,$this->searchProduct);  
            }

        }
        

        $this->showLoaderPrincipal = true;
    }
    public function rechargeFamily($id)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->searchProduct = "";
        $this->familyInfo = false;
        $this->dispatchBrowserEvent('refreshComponent',["id" => $id]);
    }

     public function openDetailProduto($idCategory, $idFamily, $idSubFamily, $productNumber,$idCustomer, $productName)
    {
        // dd($idCategory, $idFamily, $idSubFamily, $idCustomer);
        $this->specificProduct = 1;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->idCategoryRecuar = $idCategory;
        $this->idFamilyRecuar = $idFamily;
        $this->idSubFamilyRecuar = $idSubFamily;
        

        $this->detailProduto = $this->encomendasRepository->getProdutos($idCategory,$idFamily,$idSubFamily,$productNumber,$idCustomer);
 

        session(['detailProduto' => $this->detailProduto]);
        session(['productNameDetail' => $productName]);

        session(['family' => $idFamily]);
        session(['subFamily' => $idSubFamily]);
        session(['productNumber' => $productNumber]);
       
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

        if($this->searchProduct != "")
        {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->idCategoryRecuar, $this->idFamilyRecuar, $this->idSubFamilyRecuar,$this->searchProduct); 
            session(['searchProduct' => $this->searchProduct]);
        } else {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamily($this->idCategoryRecuar, $this->idFamilyRecuar, $this->idSubFamilyRecuar);  
            Session::forget('searchProduct');
        }

        session(['searchSubFamily' => $this->searchSubFamily]);
       
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

       
        
  
        return redirect()->route('encomendas.detail', ['id' => $this->idCliente]);
   
    }
    public function adicionarProduto($categoryNumber,$familyNumber,$subFamilyNumber,$productNumber,$customerNumber,$productName)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->quickBuyProducts = $this->encomendasRepository->getProdutos($categoryNumber,$familyNumber,$subFamilyNumber,$productNumber,$customerNumber);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";

        $this->specificProduct = 0;

        session(['quickBuyProducts' => $this->quickBuyProducts]);
        session(['productName' => $productName]);

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

            $this->searchProduct = "";
            //unset($_SESSION['searchProduct']);
            session()->forget('searchProduct');

            $this->filter = true;
            $this->familyInfo = true;
            $this->idFamilyInfo = $idFamily;

            $this->showLoaderPrincipal = false;

            $this->specificProduct = 0;

            $this->iteration++;

            $this->dispatchBrowserEvent('refreshComponent',["id" => $idCategory]);
    }
    public function searchSubFamily($idCategory, $idFamily, $idSubFamily)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->searchSubFamily = $this->encomendasRepository->getSubFamily($idCategory, $idFamily, $idSubFamily);  

        $this->actualCategory = $idCategory;
        $this->actualFamily = $idFamily;
        $this->actualSubFamily = $idSubFamily;


        session(['searchSubFamily' => $this->searchSubFamily]);
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";


        $this->idCategoryRecuar = $idCategory;
        $this->idFamilyRecuar = $idFamily;
        $this->idSubFamilyRecuar = $idSubFamily;

        $this->filter = true;
        $this->familyInfo = true;

        $this->idFamilyInfo = "";

        $this->showLoaderPrincipal = false;

        $this->specificProduct = 0;

        $this->iteration++;

        $this->dispatchBrowserEvent('refreshAllComponent');

    }

    public function updatedSearchProduct()
    {
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        if($this->searchProduct != "")
        {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily,$this->searchProduct);  
            session(['searchSubFamily' => $this->searchSubFamily]);
    
            session(['searchProduct' => $this->searchProduct]);
        }
        else
        {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamily($this->actualCategory, $this->actualFamily, $this->actualSubFamily);  
            session(['searchSubFamily' => $this->searchSubFamily]);
    
            //unset($_SESSION['searchProduct']);
            session()->forget('searchProduct');
        }
        
       

        $this->showLoaderPrincipal = false;

        $this->specificProduct = 0;
        $this->iteration++;
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
