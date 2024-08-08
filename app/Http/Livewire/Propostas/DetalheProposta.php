<?php

namespace App\Http\Livewire\Propostas;

use Dompdf\Dompdf;
use Livewire\Component;
use App\Models\Carrinho;
use App\Mail\SendProposta;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ComentariosProdutos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ClientesInterface;
use App\Interfaces\PropostasInterface;
use App\Interfaces\EncomendasInterface;
use Illuminate\Support\Facades\Session;

class DetalheProposta extends Component
{
    use WithPagination;

    public $carrinhoCompras = [];
    private ?object $clientesRepository = null;
    private ?object $encomendasRepository = null;
    private ?object $PropostasRepository = null;

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
    public $codvisita = null;

    public bool $showLoaderPrincipal = true;

    public $selectedItemsAddKit = [];
    public $selectedItemsRemoveKit = [];
    public $valueIvaInKit = 0;


    public string $tabDetail = "";
    public string $tabProdutos = "show active";
    public string $tabDetalhesPropostas = "";
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

    public $transportadora;
    public $viaturaSanipower;
    public $levantamentoLoja;
    public $observacaoFinalizar;
    public $referenciaFinalizar;
    public $validadeProposta;

    public $lojaFinalizar;

    public $condicoesFinalizar;
    public $chequeFinalizar;
    public $pagamentoFinalizar;
    public $transferenciaFinalizar;

    public $enviarCliente;

    public ?array $lojas = NULL;

    /******** */
    

    /** PARTE DA COMPRA */

    public ?array $produtosRapida = [];
    public $produtosComment = [];
    

    /***** */

    public $kitCheck;

    public int $perPage = 10;
    protected $listeners = ["rechargeFamily" => "rechargeFamily", "cleanModal" => "cleanModal"];

    public function boot(ClientesInterface $clientesRepository, EncomendasInterface $encomendasRepository, PropostasInterface $PropostasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->encomendasRepository = $encomendasRepository;
        $this->PropostasRepository = $PropostasRepository;
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

    public function mount($codvisita, $cliente, $codEncomenda)
    {
        $this->initProperties();
        $this->idCliente = $cliente;
        $this->codEncomenda = $codEncomenda;
        $this->codvisita = $codvisita;

        $this->specificProduct = 0;
        $this->filter = false;

        $this->showLoaderPrincipal = true;
    }

    public function rechargeFamily($id)
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

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
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";

        $this->idCategoryRecuar = $idCategory;
        $this->idFamilyRecuar = $idFamily;
        $this->idSubFamilyRecuar = $idSubFamily;

        $this->detailProduto = $this->PropostasRepository->getProdutos($idCategory, $idFamily, $idSubFamily, $productNumber, $idCustomer);


        session(['quickBuyProducts' => $this->detailProduto]);

        session(['detailProduto' => $this->detailProduto]);
        session(['productNameDetail' => $productName]);

        session(['family' => $idFamily]);
        session(['subFamily' => $idSubFamily]);
        session(['productNumber' => $productNumber]);

        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        $this->filter = false;
    }

    public function recuarLista($id)
    {
        $this->specificProduct = 0;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";

        if ($this->searchProduct != "") {
            $this->searchSubFamily = $this->PropostasRepository->getSubFamilySearch($this->idCategoryRecuar, $this->idFamilyRecuar, $this->idSubFamilyRecuar, $this->searchProduct);
            session(['searchProduct' => $this->searchProduct]);
        } else {
            $this->searchSubFamily = $this->PropostasRepository->getSubFamily($this->idCategoryRecuar, $this->idFamilyRecuar, $this->idSubFamilyRecuar);
            Session::forget('searchProduct');
        }

        session(['searchSubFamily' => $this->searchSubFamily]);

        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        return redirect()->route('propostas.detail', ['id' => $this->idCliente]);

    }
    public function adicionarProduto($categoryNumber, $familyNumber, $subFamilyNumber, $productNumber, $customerNumber, $productName)
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        $this->quickBuyProducts = $this->PropostasRepository->getProdutos($categoryNumber, $familyNumber, $subFamilyNumber, $productNumber, $customerNumber);

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";

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
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";

        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        // Disparar evento para o navegador
        $this->dispatchBrowserEvent('encomendaAtual');
    }
    public function cancelarProposta()
    {
        Carrinho::where('id_proposta', $this->codEncomenda)->where("id_user", Auth::user()->id)->delete();
        ComentariosProdutos::where('id_proposta', $this->codEncomenda)->where("id_user", Auth::user()->id)->delete();

        return redirect()->route('propostas');
    }
    public function delete($itemId)
    {
        Carrinho::where('id', $itemId)->delete();

        $this->dispatchBrowserEvent('itemDeleted', ['itemId' => $itemId]);

    }

    public function deletar($referencia,$designacao)
    {

        Carrinho::where('id_encomenda', $this->codEncomenda)
                ->where('referencia', $referencia)
                ->where('designacao', $designacao)
        ->delete();

        $this->dispatchBrowserEvent('itemDeletar', ['itemId' => $referencia]);

    }


    public function deletartodos()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        Carrinho::where('id_cliente', $this->detailsClientes->customers[0]->no)->where('id_user',Auth::user()->id)->delete();

        $this->dispatchBrowserEvent('itemDeletar');
    }

    public function searchCategory($idCategory, $idFamily)
    {
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        $this->getCategories = $this->PropostasRepository->getCategoriasSearched($this->getCategoriesAll->category[$idCategory - 1]->id, $idFamily);
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
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

        $this->dispatchBrowserEvent('refreshComponent', ["id" => $idCategory]);
    }

    public function searchSubFamily($idCategory, $idFamily, $idSubFamily)
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();
        $this->searchSubFamily = $this->PropostasRepository->getSubFamily($idCategory, $idFamily, $idSubFamily);

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
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
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

        $this->dispatchBrowserEvent('refreshPage');
        // $this->dispatchBrowserEvent('refreshAllComponent');

    }

    public function updatedSearchProduct()
    {

        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        if ($this->searchProduct != "") {
            $this->searchSubFamily = $this->PropostasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily, $this->searchProduct);
            session(['searchSubFamily' => $this->searchSubFamily]);

            session(['searchProduct' => $this->searchProduct]);
        } else {
            $this->searchSubFamily = $this->PropostasRepository->getSubFamily($this->actualCategory, $this->actualFamily, $this->actualSubFamily);
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
        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        $this->familyInfo = false;

        $this->tabDetail = "";
        $this->tabProdutos = "show active";
        $this->tabDetalhesPropostas = "";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";

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

        $response = $this->encomendasRepository->addProductToDatabase($this->codvisita,$this->idCliente, $productChosen, $nameProduct, $no, $ref, $codEncomenda,"encomenda");
        
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

        $response = $this->PropostasRepository->addProductToDatabase($this->codvisita, $this->idCliente, $productChosen, $nameProduct, $no, $ref, $codProposta, "proposta");

        $responseArray = $response->getData(true);

        if ($responseArray["success"] == true) {
            if($this->produtosComment){
                $response = $this->PropostasRepository->addCommentToDatabase($responseArray["data"]["id"],$this->idCliente, $productChosen, $nameProduct, $no, $ref, $codProposta,"proposta", $productChosenComment["comentario"]);
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

                    }else  if ($prodRap == "0") {
                        $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
                        return false;
                    }
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
            $response = $this->PropostasRepository->addProductToDatabase($this->codvisita, $this->idCliente,$prodId,$nameProduct,$no,$ref,$codEncomenda, "proposta");
            
            $responseArray = $response->getData(true);

            foreach($productChosenComment as $comeProd){
               
                if(($prodId["product"]->referense == $comeProd["product"]->referense) && ($prodId["product"]->model == $comeProd["product"]->model) && ($prodId["product"]->price == $comeProd["product"]->price))
                {
                    $response = $this->PropostasRepository->addCommentToDatabase($responseArray["data"]["id"], $this->idCliente, $prodId, $nameProduct, $no, $ref, $codEncomenda,"proposta", $comeProd["comentario"]);
                }
            }
          

        }

        // foreach($productChosenComment as $prodId){
        //     $response = $this->PropostasRepository->addCommentToDatabase($this->idCliente, $prodId, $nameProduct, $no, $ref, $codEncomenda,"proposta", $prodId["comentario"]);
        // }
        if($response){
            $responseArray = $response->getData(true);
        }else{
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma quantidade", "status" => "error"]);
            return false;
        }

        if ($responseArray["success"] == true) {
            $message = "Produto adicionado á proposta!";
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
        // public $transportadora;
        // public $viaturaSanipower;
        // public $levantamentoLoja;
        // public $observacaoFinalizar;
        // public $referenciaFinalizar;
    
        // public $lojaFinalizar;
    
        // public $condicoesFinalizar;
        // public $chequeFinalizar;
        // public $pagamentoFinalizar;
        // public $transferenciaFinalizar;

        //FAZER VALIDAÇÃO PARA ESTES AQUI DE CIMA

        dd("finaliza");
        $arrayProdutos = [];

        $valorTotal = 0;
        $valorTotalComIva = 0;
        $count = 0;
    
        foreach($this->carrinhoCompras as $prod)
        {
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
                "ivaincl" => false,
                "edebito" => "",
                "desconto" => $prod->discount,
                "desc2" => "",
                "desc3" => "",
                "ettdeb" => "",
                "notas" => "sample string 12"
            ];
        }

        

        $array = [
                    "data" => date('Y-m-d'), 
                    "no" => $this->carrinhoCompras[0]->id_encomenda,
                    "etotal_siva" => number_format($valorTotal, 2, ',', '.'),
                    "etotal" => number_format($valorTotalComIva, 2, ',', '.'),
                    "referencia" => $this->referenciaFinalizar,
                    "observacoes" => $this->observacaoFinalizar,
                    "entrega" => "sample string 9",
                    "loja" => "sample string 10",
                    "pagamento" => "sample string 11",
                    "vendedor_id" =>  Auth::user()->id_phc, 
                    "produtos" => $arrayProdutos
        ];
              
        
        $encoded_finalizar = json_encode($array);

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
            Carrinho::where('id_proposta', $codEncomenda)
                                ->where('referencia', $referencia)
                                ->where('designacao', $designacao)
                                ->update($novosValores);
        }

        $this->selectedItems = [];

        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesPropostas = "show active";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";
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
            Carrinho::where('id_proposta', $codEncomenda)
                                ->where('referencia', $referencia)
                                ->where('designacao', $designacao)
                                ->update($novosValores);
        }

        $this->selectedItems = [];

        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesPropostas = "show active";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";
        $this->dispatchBrowserEvent('checkToaster');
    }
    
    public function ivaInKit()
    {
    
        $codEncomenda = $this->codEncomenda;
        $valueIvaInKit = $this->valueIvaInKit;
        $novosValores = [
            'iva2' => intval($valueIvaInKit),
        ];
        Carrinho::where('id_proposta', $codEncomenda)
        ->where('inKit', 1)
        ->update($novosValores);
        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesPropostas = "show active";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";
    }

    public function updatedKitCheck()
    {
        $this->tabDetail = "";
        $this->tabProdutos = "";
        $this->tabDetalhesPropostas = "show active";
        $this->tabFinalizar = "";
        $this->tabDetalhesCampanhas = "";
    }

    public function goBack()
    {
        $rota = Session::get('rota');

        $parametro = Session::get('parametro');
     
        if($rota != "")
        {
            
            if($parametro != "")
            {
                return redirect()->route($rota,$parametro);
            }

            return redirect()->route($rota);

        }
    }

    public function voltarAtras()
    {
        // $this->dispatchBrowserEvent('changeRoute');

        $rota = Session::get('rota');

        $parametro = Session::get('parametro');
     
        if($rota != "")
        {
            
            if($parametro != "")
            {
                return redirect()->route($rota,$parametro);
            }

            return redirect()->route($rota);

        
        }


    }

    public function finalizarproposta()
    {
        $count = 0;
        $valorTotal = 0;
        $valorTotalComIva = 0;
       

        $idCliente = "";

        foreach($this->carrinhoCompras as $prod)
        {
            $count++;

            $idCliente = $prod->id_cliente;


            $totalItem = $prod->price * $prod->qtd;
            $totalItemComIva = $totalItem + ($totalItem * ($prod->iva / 100));
            $valorTotal += $totalItem;
            $valorTotalComIva += $totalItemComIva;

            $comentarioCheck = ComentariosProdutos::where('id_proposta', $this->codEncomenda)
            ->where('tipo','proposta')
            ->where('id_carrinho_compras', $prod->id)
            ->first();

            if(empty($comentarioCheck))
            {
                $comentario = "";
            } else {
                $comentario = $comentarioCheck->comentario;
            }

            if($prod->id_visita == null)
            {
                $visitaCheck = 0;
            } 
            else {
                $visitaCheck = $prod->id_visita;
            }

            $arrayProdutos[$count] = [
                "id" => $count,
                "reference" => $prod->referencia,
                "description" => $prod->designacao,
                "quantity" => $prod->qtd,
                "tax" => $prod->iva,
                "tax_included" => false,
                "price" => $prod->price,
                "discount1" => $prod->discount,
                "discount2" => $prod->discount2,
                "discount3" => 0,
                "total" => $totalItem,
                "notes" => $comentario,
                "visit_id" => $visitaCheck, // ou tenho de trazer da base de dados
                "budgets_id" => ""
            ];
        }

       
        $randomNumber = '';
        for ($i = 0; $i < 8; $i++) {
            $randomNumber .= rand(0, 9);
        }


        $condicaoPagamento = "";

        if($this->transferenciaFinalizar == true)
        {
            $condicaoPagamento = "Transferência Bancária";
        }
        if($this->pagamentoFinalizar == true)
        {
            $condicaoPagamento = "Pronto Pagamento";
        }
        if($this->chequeFinalizar == true)
        {
            $condicaoPagamento = "Cheque a 30 dias";
        }
        if($this->condicoesFinalizar == true)
        {
            $condicaoPagamento = "Condições acordadas";
        }
       

        if($condicaoPagamento == "")
        {
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Tem de selecionar uma condição de pagamento", "status" => "error"]);
            return false;
        }

       
        $array = [
            "id" => $randomNumber,
            "date" => date('Y-m-d').'T'.date('H:i:s'), 
            "customer_number" => $idCliente,
            "total_without_tax" => number_format($valorTotal, 2, ',', '.'),
            "total" => number_format($valorTotalComIva, 2, ',', '.'),
            "reference" => $this->referenciaFinalizar,
            "comments" => $this->observacaoFinalizar,
            "payment_conditions" => $condicaoPagamento,
            "salesman_number" => Auth::user()->id_phc,
            "type" => "budget",
            "validity" => $this->validadeProposta.'T'.date('H:i:s'),
            "lines" => array_values($arrayProdutos)
        ];

        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('SANIPOWER_URL').'/api/documents/budgets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($array),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);


        if($this->enviarCliente == true)
        {

            if ($response_decoded->success == true) {

                $proposta = $this->clientesRepository->getPropostaID($response_decoded->id_document);


                $pdf = new Dompdf();
                $pdf = PDF::loadView('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta->budgets[0])]);
            
                $pdf->render();
            
                $pdfContent = $pdf->output();
            
                $emailCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
               
                $emailArray = explode("; ", $emailCliente["object"]->customers[0]->email);

                dd("Erro"); 
                foreach($emailArray as $i => $email)
                {
                    Mail::to($email)->send(new SendProposta($pdfContent));
                }
                   
            }
          
            
        }

        if ($response_decoded->success == true) {
           
            $getEncomenda = Carrinho::where('id_proposta','!=', "")->where('id_cliente',$idCliente)->first();


            ComentariosProdutos::where('id_proposta', $getEncomenda->id_proposta)->delete();
            Carrinho::where('id_proposta', $getEncomenda->id_proposta)->delete();

            $this->dispatchBrowserEvent('checkToaster', ["message" => "Proposta finalizada com sucesso", "status" => "success"]);
        }
        else {
            $this->dispatchBrowserEvent('checkToaster', ["message" => "A proposta não foi finalizada", "status" => "error"]);
        }
        
        return redirect()->route('dashboard');

    }

    public function render()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        $this->getCategories = $this->PropostasRepository->getCategorias();
        $this->getCategoriesAll = $this->PropostasRepository->getCategorias();

        if (session('searchSubFamily') !== null) {
            $sessao = session('searchSubFamily');

            foreach ($sessao->product as $prod) {
                $this->actualCategory = $prod->category_number;
                $this->actualFamily = $prod->family_number;
                $this->actualSubFamily = $prod->subfamily_number;

                break;
            }

            $this->searchSubFamily = $this->PropostasRepository->getSubFamily($this->actualCategory, $this->actualFamily, $this->actualSubFamily);
        } else {
            $this->getCategories = $this->PropostasRepository->getCategorias();

            $firstCategories = $this->getCategories->category[0];
            session(['searchNameCategory' => $firstCategories->name]);

            $firstFamily = $firstCategories->family[0];
            session(['searchNameFamily' => $firstFamily->name]);

            $firstSubFamily = $firstFamily->subfamily[0];
            session(['searchNameSubFamily' => $firstSubFamily->name]);

            $this->searchSubFamily = $this->PropostasRepository->getSubFamily($firstCategories->id, $firstFamily->id, $firstSubFamily->id);
            session(['searchSubFamily' => $this->searchSubFamily]);
        }

        if (session('searchProduct') !== null) {
            $this->searchProduct = session('searchProduct');

            if ($this->searchProduct != "") {
                $this->searchSubFamily = $this->PropostasRepository->getSubFamilySearch($this->actualCategory, $this->actualFamily, $this->actualSubFamily, $this->searchProduct);
            }

        }

        $this->carrinhoCompras = Carrinho::where('id_cliente', $this->detailsClientes->customers[0]->no)
            ->where('id_user',Auth::user()->id)
            ->where('id_proposta', '!=', '')
            ->where('id_proposta', $this->codEncomenda)
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

   
        return view('livewire.propostas.detalhe-proposta',["onkit" => $onkit, "allkit" => $allkit, "detalhesCliente" => $this->detailsClientes, "getCategories" => $this->getCategories,'getCategoriesAll' => $this->getCategoriesAll,'searchSubFamily' =>$this->searchSubFamily, "arrayCart" =>$arrayCart, "codEncomenda" => $this->codEncomenda]);

    }
}
