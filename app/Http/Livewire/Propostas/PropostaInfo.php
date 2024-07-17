<?php

namespace App\Http\Livewire\Propostas;

use App\Mail\SendProposta;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Carrinho;
use App\Models\ComentariosProdutos;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use App\Interfaces\PropostasInterface;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PropostaInfo extends Component
{
    use WithPagination ;


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

    public bool $showLoaderPrincipal = true;

    public string $tabDetail = "show active";
    public string $tabProdutos = "";
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

    public $lojaFinalizar;

    public $condicoesFinalizar;
    public $chequeFinalizar;
    public $pagamentoFinalizar;
    public $transferenciaFinalizar;

    public ?array $lojas = NULL;

    /******** */
    

    /** PARTE DA COMPRA */

    public ?array $produtosRapida = [];
    public $produtosComment = [];
    

    /***** */

    private ?object $proposta = NULL;

    public int $perPage = 10;

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

    public function mount($proposta)
    {
        $this->initProperties();
        $this->proposta = $proposta;
        session()->put('proposta', $this->proposta);
        $this->specificProduct = 0;
        $this->filter = false;

        $this->showLoaderPrincipal = true;
    }
    public function enviarEmail($proposta)
    {

        if (!$proposta) {
            dd("Não há valor na variável \$proposta");
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }
    
        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta)])->render());
    
        $pdf->render();
    
        $pdfContent = $pdf->output();
    
        try {
            Mail::to(Auth::user()->email)->send(new SendProposta($pdfContent));
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Email enviado!", "status" => "success"]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('checkToaster', ["message" => $e->getMessage(), "status" => "warning"]);
        }
    }

    public function gerarPdfProposta($proposta)
    {
        // Recuperar os registros do banco dados
        // Gerar o PDF usando DomPDF
        if (!$proposta) {
            dd("nao tem valor no proposta");
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }
        // Gerar o PDF usando DomPDF
        $pdf = PDF::loadView('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta)]);
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'pdfTabelaPropostas.pdf');
    }

    public function adjudicarProposta($proposta)
    {

       Carrinho::where('id_cliente', $proposta["number"])->where("id_user", Auth::user()->id)->delete();
       ComentariosProdutos::where('no', $proposta["number"])->where("id_user", Auth::user()->id)->delete();
        

        foreach($proposta["lines"] as $prop)
        {
           
            Carrinho::create([
                "id_proposta" => $proposta["id"],
                "id_cliente" => $proposta["number"],
                "id_user" => Auth::user()->id_phc,
                "referencia" => $prop["reference"],
                "designacao" => $prop["description"],
                "price" => $prop["price"],
                "discount" => $prop["discount"],
                "discount2" => $prop["discount2"],
                "qtd" => $prop["quantity"],
                "iva" => 12,
                "image_ref" => "https://storage.sanipower.pt/storage/produtos/".$prop["family_number"]."/".$prop["family_number"]."-".$prop["subfamily_number"]."-".$prop["product_number"].".jpg"
            ]);
        }


        session()->flash("success", "Proposta adjudicada com sucesso");
        return redirect()->route('propostas');
      

    }
   
    
    public function render()
    {

        // foreach ($this->proposta->lines as $prod){
        //     $image_ref = "https://storage.sanipower.pt/storage/produtos/".$prod->family_number."/".$prod->family_number."-".$prod->subfamily_number."-".$prod->product_number.".jpg";
        //     $prod->image_ref = $image_ref;
        // }

        // $imagens = [];
        // foreach($this->proposta->lines as $carrinho){
        //     array_push($imagens,$carrinho->image_ref);
        // }
        
        // $iamgens_unique = array_unique($imagens);


        // $arrayCart = [];

        // foreach ($iamgens_unique as $img) {
        //     $arrayCart[$img] = [];
        //     foreach ($this->proposta->lines as $cart) {
        //         if ($img == $cart->image_ref) {
        //             $found = false;
        //             foreach ($arrayCart[$img] as &$item) {
                        
        //                 if ($item->reference == $cart->reference) {
        //                     $item->qtd += $cart->qtd;
        //                     $found = true;
        //                     break;
        //                 }
        //             }
        //             if (!$found) {
        //                 array_push($arrayCart[$img], $cart);
        //             }
        //         }
        //     }
        // }

        $proposta = session()->get('proposta');
       
        return view('livewire.propostas.proposta-info',["proposta" => $proposta]);

    }
}