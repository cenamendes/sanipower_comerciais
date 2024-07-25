<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use App\Models\Carrinho;
use App\Models\ComentariosProdutos;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use App\Interfaces\PropostasInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class DetalheEncomenda extends Component
{
    use WithPagination;

    public $carrinhoCompras = [];
    private ?object $clientesRepository = null;
    private ?object $encomendasRepository = null;
    private ?object $propostasRepository = null;

    protected ?object $clientes = null;
    public string $addProductQuickBuy = "";

    private ?object $detailsClientes = null;
    private ?object $searchSubFamily = null;
    private ?object $getCategories = null;
    private ?object $getCategoriesAll = null;
    private ?object $products = null;
    public ?string $searchTextCategory = "";
    public bool $filter;
    public bool $familyInfo = false;

    public bool $showLoaderPrincipal = true;

    public $selectedItemsAddKit = [];
    public $selectedItemsRemoveKit = [];
    public $valueIvaInKit = 0;

    public string $tabDetail = "";
    public string $tabProdutos = "show active";
    public string $tabDetalhesEncomendas = "";
    public string $tabFinalizar = "";
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

    protected ?object $quickBuyProducts = null;
    public $iterationQuickBuy = 0;

    private ?object $detailProduto = null;

    public $modalShow = false;

    public $iterationDelete = 0;


    /** PARTE DO FINALIZAR **/

    public $transportadora = false;
    public $viaturaSanipower = false;
    public $levantamentoLoja = false;
    public $observacaoFinalizar;
    public $referenciaFinalizar;

    public $lojaFinalizar = "";

    public $condicoesFinalizar = false;
    public $chequeFinalizar = false;
    public $pagamentoFinalizar = false;
    public $transferenciaFinalizar = false;

    public ?array $lojas = NULL;

    /******** */


    /** PARTE DA COMPRA */
    public $produtosRapida = [];
    public $produtosComment = [];

    /***** */

    public ?object $encomenda = NULL;

    public int $perPage = 10;
    protected $listeners = ["rechargeFamily" => "rechargeFamily", "cleanModal" => "cleanModal" ,'campoAlterado' =>'campoAlterado', 'addProductCommentEncomenda'=>'addProductCommentEncomenda'];

    public function boot(ClientesInterface $clientesRepository, EncomendasInterface $encomendasRepository, PropostasInterface $propostasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->encomendasRepository = $encomendasRepository;
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

    public function mount($cliente, $codEncomenda)
    {
        $this->initProperties();
        $this->idCliente = $cliente;
        $this->codEncomenda = $codEncomenda;


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
        $this->dispatchBrowserEvent('refreshComponent', ["id" => $id]);
    }

    public function openDetailProduto($idCategory, $idFamily, $idSubFamily, $productNumber, $idCustomer, $productName)
    {
        // dd($idCategory, $idFamily, $idSubFamily, $idCustomer);
        $this->specificProduct = 1;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";

        $this->idCategoryRecuar = $idCategory;
        $this->idFamilyRecuar = $idFamily;
        $this->idSubFamilyRecuar = $idSubFamily;

        $this->detailProduto = $this->encomendasRepository->getProdutos($idCategory, $idFamily, $idSubFamily, $productNumber, $idCustomer);
    
        session(['quickBuyProducts' => $this->detailProduto]);

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
        $this->tabFinalizar = "";

        if ($this->searchProduct != "") {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->idCategoryRecuar, $this->idFamilyRecuar, $this->idSubFamilyRecuar, $this->searchProduct);
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
    public function adicionarProduto($categoryNumber, $familyNumber, $subFamilyNumber, $productNumber, $customerNumber, $productName)
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->quickBuyProducts = $this->encomendasRepository->getProdutos($categoryNumber, $familyNumber, $subFamilyNumber, $productNumber, $customerNumber);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";

        $this->specificProduct = 0;

        session(['quickBuyProducts' => $this->quickBuyProducts]);
        session(['productName' => $productName]);

        session(['detailProduto' => $this->detailProduto]);
        session(['productNameDetail' => $productName]);

        session(['family' => $familyNumber]);
        session(['subFamily' => $subFamilyNumber]);
        session(['productNumber' => $productNumber]);

        $this->produtosRapida = [];

        $this->dispatchBrowserEvent('compraRapida');

    }

    public function verEncomenda()
    {
        // Atualizar abas
        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";

        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        // Disparar evento para o navegador
        $this->dispatchBrowserEvent('encomendaAtual');
    }
    public function cancelarEncomenda()
    {
        Carrinho::where('id_encomenda', $this->codEncomenda)->where("id_user", Auth::user()->id)->delete();
        ComentariosProdutos::where('id_encomenda', $this->codEncomenda)->where("id_user", Auth::user()->id)->delete();

        return redirect()->route('encomendas');
    }

    public function delete($itemId)
    {
        Carrinho::where('id', $itemId)->delete();

        $this->dispatchBrowserEvent('itemDeleted', ['itemId' => $itemId]);

    }

    public function deletar($itemReference)
    {
        Carrinho::where('id_encomenda', $this->codEncomenda)
        ->where('referencia', $itemReference)
        ->delete();


        $this->dispatchBrowserEvent('itemDeletar', ['itemId' => $itemReference]);
    }


    public function deletartodos()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        Carrinho::where('id_cliente', $this->detailsClientes->customers[0]->no)->where('id_user',Auth::user()->id)->delete();

        $this->dispatchBrowserEvent('itemDeletar');
    }

    public function searchCategory($idCategory, $idFamily)
    {
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();

        $this->getCategories = $this->encomendasRepository->getCategoriasSearched($this->getCategoriesAll->category[$idCategory - 1]->id, $idFamily);
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesEncomendas = "";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";

        $this->searchProduct = "";
        //unset($_SESSION['searchProduct']);
        session()->forget('searchProduct');

        $this->filter = true;
        $this->familyInfo = true;
        $this->idFamilyInfo = $idFamily;

        $this->showLoaderPrincipal = false;

        $this->specificProduct = 0;

        $this->iteration++;

        $this->dispatchBrowserEvent('refreshComponent', ["id" => $idCategory]);
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

                foreach ($idCtgry->family as $idFmly) {
                    if ($idFmly->id === $idFamily) {
                        session(['searchNameFamily' => $idFmly->name]);

                        foreach ($idFmly->subfamily as $idSubFmly) {
                            if ($idSubFmly->id === $idSubFamily) {
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
        $this->tabFinalizar = "";

        $this->idCategoryRecuar = $idCategory;
        $this->idFamilyRecuar = $idFamily;
        $this->idSubFamilyRecuar = $idSubFamily;

        $this->filter = true;
        $this->familyInfo = true;

        $this->idFamilyInfo = "";

        $this->showLoaderPrincipal = false;

        $this->specificProduct = 0;

        $this->iteration++;

        
        $this->dispatchBrowserEvent('refreshPage');
        // $this->dispatchBrowserEvent('refreshAllComponent');

    }

    public function updatedSearchProduct()
    {

        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        if ($this->searchProduct != "") {
            $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily, $this->searchProduct);
            session(['searchSubFamily' => $this->searchSubFamily]);

            session(['searchProduct' => $this->searchProduct]);
        } else {
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
        $this->tabFinalizar = "";

        $this->specificProduct = 0;

        $this->showLoaderPrincipal = false;

        $this->dispatchBrowserEvent('refreshComponent2', ["id" => $this->getCategoriesAll->category[$idCategory - 1]->id]);
    }
    public function addProductQuickBuyEncomenda($prodID, $nameProduct, $no, $ref, $codEncomenda)
    {
        $quickBuyProducts = session('quickBuyProducts');

        $flag = 0;
        if(empty($this->produtosRapida[$prodID]))
        {
            $this->produtosRapida = [];
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
            return false;
        }
        
        $productChosen = [];
        $productChosenComment = [];


        foreach ($quickBuyProducts->product as $i => $prod) {
            if ($i == $prodID) {
                foreach ($this->produtosRapida as $j => $prodRap) {

                    if ($i == $j) {

                        if ($prodRap == "0" || $prodRap == "") {
                            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                            $flag = 1;
                            break;
                        } else {

                            if ($prod->in_stock == false) {
                                $this->dispatchBrowserEvent('checkToaster', ["message" => "Não existe quantidades em stock", "status" => "error"]);
                                $flag = 1;
                                break;
                            }
                            $productChosen = ["product" => $prod, "quantidade" => $prodRap];
                        }
                    }
                }
                if($this->produtosComment){
                    foreach ($this->produtosComment as $j => $prodComm) {
                        if ($i == $j) {
                            $productChosenComment = ["comentario" => $prodComm];
                        }
                    }
                }
            }

            if ($flag == 1) {
                break;
            }

        }
        if ($flag == 1) {
            return false;
        }

        $response = $this->encomendasRepository->addProductToDatabase($this->idCliente, $productChosen, $nameProduct, $no, $ref, $codEncomenda,"encomenda");

        $responseArray = $response->getData(true);

        

        if ($responseArray["success"] == true) {
    
            if($this->produtosComment){
                $response = $this->encomendasRepository->addCommentToDatabase($responseArray["data"]["id"],$this->idCliente, $productChosen, $nameProduct, $no, $ref, $codEncomenda,"encomenda", $productChosenComment["comentario"]);
                $this->produtosComment = [];
            }

            if($responseArray["encomenda"] != "") {
                $message = "Produto adicionado á encomenda!";
            } else {
                $message = "Produto adicionado á proposta!";
            }
            $status = "success";
        } else {
            $message = "Não foi possivel adicionar o produto!";
            $status = "error";
        }
        $this->produtosRapida = [];
        $this->produtosComment = [];
        
        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);
    }
    public function addProductQuickBuyProposta($prodID, $nameProduct, $no, $ref, $codProposta)
    {
        $quickBuyProducts = session('quickBuyProducts');
        
        $flag = 0;
        if(empty($this->produtosRapida[$prodID]))
        {
            $this->produtosRapida = [];
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
            return false;
        }

        $productChosen = [];
        $productChosenComment = [];

        foreach ($quickBuyProducts->product as $i => $prod) {
            if ($i == $prodID) {
                foreach ($this->produtosRapida as $j => $prodRap) {

                    if ($i == $j) {

                        if ($prodRap == "0" || $prodRap == "") {
                            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                            $flag = 1;
                            break;
                        } else {

                            if ($prod->in_stock == false) {
                                $this->dispatchBrowserEvent('checkToaster', ["message" => "Não existe quantidades em stock", "status" => "error"]);
                                $flag = 1;
                                break;
                            }
                            $productChosen = ["product" => $prod, "quantidade" => $prodRap];
                        }
                    }
                }
                if($this->produtosComment){
                    foreach ($this->produtosComment as $j => $prodComm) {
                        if ($i == $j) {
                            $productChosenComment = ["comentario" => $prodComm];
                        }
                    }
                }
            }

            if ($flag == 1) {
                break;
            }

        }

        if ($flag == 1) {
            return false;
        }

        $response = $this->encomendasRepository->addProductToDatabase($this->idCliente, $productChosen, $nameProduct, $no, $ref, $codProposta, "proposta");

        $responseArray = $response->getData(true);

        if ($responseArray["success"] == true) {
            if($this->produtosComment){
                $response = $this->propostasRepository->addCommentToDatabase($this->idCliente, $productChosen, $nameProduct, $no, $ref, $codProposta,"proposta", $productChosenComment["comentario"]);
                $this->produtosComment = [];
            }
            if($responseArray["encomenda"] != "") {
                $message = "Produto adicionado á encomenda!";
            } else {
                $message = "Produto adicionado á proposta!";
            }
            $status = "success";
        } else {
            $message = "Não foi possivel adicionar o produto!";
            $status = "error";
        }
        $this->produtosRapida = [];
        $this->produtosComment = [];

        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);
    }
    public function CleanAll()
    {
        $this->produtosRapida = [];
        $this->produtosComment = [];

    }
    public function addAll($nameProduct,$no, $ref ,$codEncomenda)
    {
        $quickBuyProducts = session('quickBuyProducts');

        $productChosen = [];
        $productChosenComment = [];
        $count = 0;

        if (empty($this->produtosRapida)) {
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
            return false;
        }
        foreach ($quickBuyProducts->product as $i => $prod) {
            foreach ($this->produtosRapida as $j => $prodRap) {

                if ($i == $j) {
                    if ($prodRap != "0" && $prodRap != "") {
                        if ($prod->in_stock == true) {
                            $productChosen[$count] = [
                                "product" => $prod,
                                "quantidade" => $prodRap,
                            ];
                            $count++;
                        }
                    }
                }else if ($prodRap == "0") {
                    $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                    return false;
                }
            }
            foreach ($this->produtosComment as $j => $prodComm) {
                if ($i == $j) {
                    if ($prodComm != "0" && $prodComm != "") {
                        if ($prod->in_stock == true) {
                            $productChosenComment[$count] = [
                                "product" => $prod,
                                "comentario" => $prodComm,
                            ];
                            $count++;
                        }
                    }else  if ($prodComm == "0") {
                        $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                        return false;
                    }
                }
            }
        }
        $response = [];
        foreach($productChosen as $prodId){
            
            $response = $this->encomendasRepository->addProductToDatabase($this->idCliente,$prodId,$nameProduct,$no,$ref,$codEncomenda, "encomenda");
        }

        foreach($productChosenComment as $prodId){
            $response = $this->encomendasRepository->addCommentToDatabase($this->idCliente, $prodId, $nameProduct, $no, $ref, $codEncomenda,"encomenda", $prodId["comentario"]);
        }
        
        $responseArray = $response->getData(true);

        if ($responseArray["success"] == true) {
            $message = "Produto adicionado á encomenda!";
            $status = "success";
        } else {
            $message = "Não foi possivel adicionar o produto!";
            $status = "error";
        }

        $this->produtosRapida = [];
        $this->produtosComment = [];

        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);

    }

    public function cleanModal()
    {
        $this->produtosRapida = [];

        $this->dispatchBrowserEvent('compraRapida');

        $this->skipRender();
    }


    public function finalizarencomenda()
    {
    
        // Outros métodos e propriedades
        // dd( $this->lojaFinalizar);
    
 
        //     $properties = [
        //         'transportadora' => $this->transportadora,
        //         'viaturaSanipower' => $this->viaturaSanipower,
        //         'levantamentoLoja' => $this->levantamentoLoja,
        //         'observacaoFinalizar' => $this->observacaoFinalizar,
        //         'referenciaFinalizar' => $this->referenciaFinalizar,
        //         'lojaFinalizar' => $this->lojaFinalizar,
        //         'condicoesFinalizar' => $this->condicoesFinalizar,
        //         'chequeFinalizar' => $this->chequeFinalizar,
        //         'pagamentoFinalizar' => $this->pagamentoFinalizar,
        //         'transferenciaFinalizar' => $this->transferenciaFinalizar,
        //     ];
        //     dd( $properties);
        //     foreach ($properties as $property => $value) {
        //         if (is_null($value)) {
        //             return "A propriedade '$property' não está definida ou é nula.";
        //         }
        //     }
            
        $propertiesLoja = [
            'levantamentoLoja' => $this->levantamentoLoja,
            'viaturaSanipower' => $this->viaturaSanipower,
            'transportadora' => $this->transportadora,
            
        ];
        $propertiesPagamentos = [
           'condicoesFinalizar' => $this->condicoesFinalizar,
            'chequeFinalizar' => $this->chequeFinalizar,
            'pagamentoFinalizar' => $this->pagamentoFinalizar,
            'transferenciaFinalizar' => $this->transferenciaFinalizar,
            
        ];

        $resultLoja = [];
        foreach ($propertiesLoja as $property => $value) {
            if ($value === true) {
                $resultLoja[] = $property;
            }
        }
        if(empty($resultLoja)){
            $resultLoja[0]= "";
        }
        $resultPagamento = [];
        foreach ($propertiesPagamentos as $property => $value) {
            if ($value === true) {
                $resultPagamento[] = $property;
            }
        }
        if(empty($resultPagamento)){
            $resultPagamento[0] = "";
        }
        //FAZER VALIDAÇÃO PARA ESTES AQUI DE CIMA

        // Inicializar variáveis
        $count = 0;
        $valorTotal = 0;
        $valorTotalComIva = 0;
        $arrayProdutos = [];
        $uniqueProducts = [];
        foreach ($this->carrinhoCompras as $prod) {
            $nota = ComentariosProdutos::where('reference', $prod->referencia)
                        ->where('id_encomenda', $prod->id_encomenda)
                        ->first();

            if (is_null($nota)) {
                $notaComentario = "";
            } else {
                $notaComentario = $nota->comentario;
            }

            $uniqueIdentifier = $prod->referencia . '-' . $prod->id_cliente . '-' . $prod->price. '-' . $prod->discount;;
        
            if (isset($uniqueProducts[$uniqueIdentifier])) {
                $index = $uniqueProducts[$uniqueIdentifier];
                $arrayProdutos[$index]['qtt'] += $prod->qtd;
                $totalItem = $prod->price * $prod->qtd;
                $totalItemComIva = $totalItem + ($totalItem * ($prod->iva / 100));
                $valorTotal += $totalItem;
                $valorTotalComIva += $totalItemComIva;
            } else {
                $count++;
                $totalItem = $prod->price * $prod->qtd;
                $totalItemComIva = $totalItem + ($totalItem * ($prod->iva / 100));
                $valorTotal += $totalItem;
                $valorTotalComIva += $totalItemComIva;
        
                $arrayProdutos[$count] = [
                    "linha_id" => $count,
                    "ref" => $prod->referencia,
                    "design" => $prod->designacao,
                    "qtt" => $prod->qtd,
                    "iva" => $prod->iva,
                    "ivaincl" => "",
                    "edebito" => "",
                    "desconto" => $prod->discount,
                    "desc2" => "",
                    "desc3" => "",
                    "ettdeb" => "",
                    "notas" => $notaComentario
                ];
        
                $uniqueProducts[$uniqueIdentifier] = $count;
            }
        }
        $array = [
            "bistamp" => "",
            "obrano" => null,
            "data" => date('Y-m-d'),
            "no" => intval($prod->id_cliente),
            "etotal_siva" => number_format($valorTotal, 2, ',', '.'),
            "etotal" => number_format($valorTotalComIva, 2, ',', '.'),
            "referencia" => $this->referenciaFinalizar,
            "observacoes" => $this->observacaoFinalizar,
            "entrega" => $resultLoja[0],
            "loja" => $this->lojaFinalizar,
            "pagamento" => $resultPagamento[0],
            "vendedor_id" => intval(Auth::user()->id_phc),
            "encomendano" => intval($this->codEncomenda),
            "visita_id" => 0,
            "proposta_id" => "",
            "tipo" => "Encomenda",
            "encomenda_vendedor_no" => intval(Auth::user()->id_phc),
            "produtos" => array_values($arrayProdutos),
        ];

        $encoded_finalizar = json_encode($array);


        // dd($encoded_finalizar);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('SANIPOWER_URL').'/api/documents/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $encoded_finalizar,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);

        dd($encoded_finalizar);

    }
    

    public function AdicionarItemKit()
    {
        
        $selectedProductIds = array_keys(array_filter($this->selectedItemsAddKit));

        $codEncomenda = $this->codEncomenda;
        foreach ($selectedProductIds as $itemId) {
            
            $selectedItemsArray = json_decode($itemId, true);

            $designacao = $selectedItemsArray[2];
            $designacao = str_replace('£', '.', $designacao);
            
            $referencia = $selectedItemsArray[1];
            $referencia = str_replace('£', '.', $referencia);

            $novosValores = [
                'inkit' => 1,
            ];
            Carrinho::where('id_encomenda', $codEncomenda)
                                ->where('referencia', $referencia)
                                ->where('designacao', $designacao)
                                ->update($novosValores);
        }

        $this->selectedItemsAddKit = [];

        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesEncomendas = "show active";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";
        $this->dispatchBrowserEvent('checkToaster');
    }
    public function RemoverItemKit()
    {
        $selectedProductIds = array_keys(array_filter($this->selectedItemsRemoveKit));
        $codEncomenda = $this->codEncomenda;
        foreach ($selectedProductIds as $itemId) {
            
            $selectedItemsArray = json_decode($itemId, true);

            $designacao = $selectedItemsArray[2];
            $designacao = str_replace('£', '.', $designacao);
            
            $referencia = $selectedItemsArray[1];
            $referencia = str_replace('£', '.', $referencia);

            $novosValores = [
                'inkit' => 0,
                'iva2' => 0,

            ];
            Carrinho::where('id_encomenda', $codEncomenda)
                                ->where('referencia', $referencia)
                                ->where('designacao', $designacao)
                                ->update($novosValores);
        }

        $this->selectedItems = [];

        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesEncomendas = "show active";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";
        $this->dispatchBrowserEvent('checkToaster');
    }
    
    public function ivaInKit()
    {
    
        $codEncomenda = $this->codEncomenda;
        $valueIvaInKit = $this->valueIvaInKit;
        $novosValores = [
            'iva2' => intval($valueIvaInKit),
        ];
        Carrinho::where('id_encomenda', $codEncomenda)
        ->where('inKit', 1)
        ->update($novosValores);
        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesEncomendas = "show active";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";
    }

    public function updatedKitCheck()
    {
       
        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesEncomendas = "show active";
        $this->tabDetalhesCampanhas = "";
        $this->tabFinalizar = "";
    }

    public function voltarAtras()
    {
        $this->dispatchBrowserEvent('changeRoute');

    }
    
    public function render()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->getCategories = $this->encomendasRepository->getCategorias();
        $this->getCategoriesAll = $this->encomendasRepository->getCategorias();
   
        if (session('searchSubFamily') !== null) {
            $sessao = session('searchSubFamily');

            foreach ($sessao->product as $prod) {
                $this->actualCategory = $prod->category_number;
                $this->actualFamily = $prod->family_number;
                $this->actualSubFamily = $prod->subfamily_number;

                break;
            }

            $this->searchSubFamily = $this->encomendasRepository->getSubFamily($this->actualCategory, $this->actualFamily, $this->actualSubFamily);
        } else {
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

        if (session('searchProduct') !== null) {
            $this->searchProduct = session('searchProduct');

            if ($this->searchProduct != "") {
                $this->searchSubFamily = $this->encomendasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily, $this->searchProduct);
            }

        }

        $this->carrinhoCompras = Carrinho::where('id_cliente', $this->detailsClientes->customers[0]->no)->where('id_user',Auth::user()->id)
        ->orderBy('inkit', 'desc')
        ->get();

        $imagens = [];

        foreach($this->carrinhoCompras as $carrinho){
            array_push($imagens,$carrinho->image_ref);
        }

        $iamgens_unique = array_unique($imagens);
        $arrayCart = [];
        $onkit = 0;
        $allkit = 0;
        foreach ($iamgens_unique as $img) {
            $arrayCart[$img] = [];
            foreach ($this->carrinhoCompras as $cart) {
                if($cart->inkit){
                    $onkit = $cart->inkit ;
                }
                if($cart->inkit == 0){
                    $allkit = 1;
                }
                if ($img == $cart->image_ref) {
                    $found = false;
                    foreach ($arrayCart[$img] as &$item) {
                        if ($item->referencia == $cart->referencia) {
                            if(isset($cart->qtd)) {
                                if (is_numeric($item->qtd) && is_numeric($cart->qtd)) {
                                    $item->qtd += $cart->qtd;
                                } else {
                                    break;
                                }
                                $found = true;
                                break;
                            }
                        }
                    }
                    if (!$found) {
                        array_push($arrayCart[$img], $cart);
                    }
                }
            }
        }
        $this->lojas = $this->encomendasRepository->getLojas();
        return view('livewire.encomendas.detalhe-encomenda',["onkit" => $onkit, "allkit" => $allkit,"detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll,'searchSubFamily' =>$this->searchSubFamily, "arrayCart" =>$arrayCart, "codEncomenda" => $this->codEncomenda]);

    }
}
