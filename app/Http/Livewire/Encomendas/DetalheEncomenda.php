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

    public $modalShow = false;


    /** PARTE DA COMPRA */

    public ?array $produtosRapida = [];

    /***** */

    public int $perPage = 10;
    protected $listeners=["rechargeFamily" => "rechargeFamily", "cleanModal" => "cleanModal"];

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
        
        $this->specificProduct = 0;
        $this->filter = false;

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

        $this->produtosRapida = [];

        $this->dispatchBrowserEvent('compraRapida');


    }

    public function verEncomenda()
    {
        //TENHO DE ASSOCIAR Á AO USER E AO CLIENTE

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";


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
        // dd($this->getCategories->category[]);
        foreach ($this->getCategories->category as $index => $idCtgry) {

            if ($idCtgry->id == $idCategory) {
                session(['searchNameCategory' => $idCtgry->name]);


                foreach($idCtgry->family as $idFmly) {
                    if($idFmly->id === $idFamily) {
                    session(['searchNameFamily' => $idFmly->name]);

                    foreach($idFmly->subfamily as $idSubFmly) {
                        if($idSubFmly->id === $idSubFamily) {
                            session(['searchNameSubFamily' => $idSubFmly->name]);
                        }
                    }

                    }
                }

            }
        }



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
    
    public function addProductQuickBuy($prodID)
    {
        $quickBuyProducts = session('quickBuyProducts');

        $flag = 0;

        $productChosen = [];

        foreach($quickBuyProducts->product as $i => $prod)
        {
            if($i == $prodID)
            {
                foreach($this->produtosRapida as $j => $prodRap)
                {
                    if($i == $j)
                    {
                        if($prodRap == "0" || $prodRap == "")
                        {
                            $this->dispatchBrowserEvent('checkToaster',["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                            $flag = 1;
                            break;
                        } else {

                            if($prod->in_stock == false)
                            {
                                $this->dispatchBrowserEvent('checkToaster',["message" => "Não existe quantidades em stock", "status" => "error"]);
                                $flag = 1;
                                break;
                            }
                            $productChosen = ["product" => $prod, "quantidade" => $prodRap];
                        }
                    }
                }
            }

            if($flag == 1)
            {
                break;
            }
           
        }

        if($flag == 1)
        {
            return false;
        }


        //PRECISO DE PASSAR O ID DO PRODUTO DIREITO

        dD("hello", $productChosen);
        $response = $this->encomendasRepository->addProductToDatabase($this->idCliente,$prodID,$this->produtosRapida);

        $responseArray = $response->getData(true);

        if($responseArray["success"] == true){
           $message = "Produto adicionado ao carrinho com sucesso!";
           $status = "success";
        } else {
            $message = "Não foi possivel adicionar o produto!";
            $status = "error";
        }

        $this->dispatchBrowserEvent('checkToaster',["message" => $message, "status" => $status]);
    }

    public function addAll()
    {

        $quickBuyProducts = session('quickBuyProducts');

        $productChosen = [];
        $count = 0;

        if(empty($this->produtosRapida))
        {
            $this->dispatchBrowserEvent('checkToaster',["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
            return false;
        }

        foreach($quickBuyProducts->product as $i => $prod)
        {
            foreach($this->produtosRapida as $j => $prodRap)
            {
                if($i == $j)
                {
                    if($prodRap != "0" && $prodRap != "")
                    {
                        if($prod->in_stock == true)
                        {
                            $productChosen[$count] = [
                                "product" => $prod,
                                "quantidade" => $prodRap
                            ];
    
                            $count++;
                        }
                        
                    }
                }
            }   
        }

        dD($productChosen);



    }

    public function cleanModal()
    {
        $this->produtosRapida = [];

        $this->dispatchBrowserEvent('compraRapida');
        
        $this->skipRender();
    }

    public function render()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

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
        }else{
            $this->getCategories = $this->encomendasRepository->getCategorias();

            $firstCategories = $this->getCategories->category[0];
            session(['searchNameCategory' => $firstCategories->name]);

            $firstFamily = $firstCategories->family[0];
            session(['searchNameFamily' => $firstFamily->name]);

            $firstSubFamily = $firstFamily->subfamily[0];
            session(['searchNameSubFamily' => $firstSubFamily->name]);

            $this->searchSubFamily = $this->encomendasRepository->getSubFamily($firstCategories->id, $firstFamily->id, $firstSubFamily->id);
            session(['searchSubFamily' => $this->searchSubFamily]);
        }



        if(session('searchProduct') !== null)
        {
            $this->searchProduct = session('searchProduct');

            if($this->searchProduct != "")
            {
                $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily,$this->searchProduct);
            }

        }

        return view('livewire.encomendas.detalhe-encomenda',["detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll,'searchSubFamily' =>$this->searchSubFamily]);
    }
}
