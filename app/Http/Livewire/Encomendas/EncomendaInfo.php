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

class EncomendaInfo extends Component
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

    public string $tabDetail = "show active";
    public string $tabDetalhesEncomendas = "";
    

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

    public $lojaFinalizar;

    public $condicoesFinalizar;
    public $chequeFinalizar;
    public $pagamentoFinalizar;
    public $transferenciaFinalizar;

    public ?array $lojas = NULL;

    /******** */


    /** PARTE DA COMPRA */
    public $produtosRapida = [];
    public $produtosComment = [];

    /***** */

    protected ?object $encomenda = NULL;

    public int $perPage = 10;
   

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

    public function mount($encomenda)
    {
        $this->initProperties();
        $this->encomenda = $encomenda;
    

        $this->specificProduct = 0;
        $this->filter = false;

        $this->showLoaderPrincipal = true;
    }

       
    
    public function render()
    {
        
        foreach ($this->encomenda->lines as $prod){
             $image_ref = "https://storage.sanipower.pt/storage/produtos/".$prod->category_number."/".$prod->family_number."-".$prod->subfamily_number."-".$prod->product_number.".jpg";
             $prod->image_ref = $image_ref;
        }

        $imagens = [];
        foreach($this->encomenda->lines as $carrinho){
            array_push($imagens,$carrinho->image_ref);
        }
        
        $iamgens_unique = array_unique($imagens);


        $arrayCart = [];

        foreach ($iamgens_unique as $img) {
            $arrayCart[$img] = [];
            foreach ($this->encomenda->lines as $cart) {
                if ($img == $cart->image_ref) {
                    $found = false;
                    foreach ($arrayCart[$img] as &$item) {
                        
                        if ($item->reference == $cart->reference) {
                            $item->qtd += $cart->qtd;
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        array_push($arrayCart[$img], $cart);
                    }
                }
            }
        }
        return view('livewire.encomendas.encomenda-info',["encomenda" => $this->encomenda,"arrayCart" =>$arrayCart]);

    }
}
