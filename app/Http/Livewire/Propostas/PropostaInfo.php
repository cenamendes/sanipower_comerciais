<?php

namespace App\Http\Livewire\Propostas;

use Dompdf\Dompdf;
use Livewire\Component;
use App\Models\Carrinho;
use App\Mail\SendProposta;
use App\Models\Comentarios;
use Livewire\WithPagination;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ComentariosProdutos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Interfaces\ClientesInterface;
use App\Interfaces\PropostasInterface;


use Illuminate\Queue\SerializesModels;
use App\Interfaces\EncomendasInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

    public ?object $comentario = NULL;

    public $comentarioEncomenda = "";

    public $emailArray;
    public $emailSend;

    public $propostaComentarioId;

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

        dd("Erro");

        $emailArray = explode("; ", $proposta["email"]);

        $this->emailArray = $emailArray;

        array_push($this->emailArray,Auth::user()->email);
        
        $this->dispatchBrowserEvent('chooseEmail');

     
    }

    public function enviarEmailClientes($proposta)
    {
       
        if (!$proposta) {
            dd("Não há valor na variável \$proposta");
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }
    
        $pdf = new Dompdf();
        $pdf = PDF::loadView('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta)]);
    
        $pdf->render();
    
        $pdfContent = $pdf->output();
    
   
        foreach($this->emailArray as $i => $email)
        {
            if(isset($this->emailSend[$i]))
            {
                if($this->emailSend[$i] == true)
                {
                    Mail::to($email)->send(new SendProposta($pdfContent));
                }
            }
           
        }

        $this->emailArray = [];

        $this->dispatchBrowserEvent('checkToaster', ["message" => "Email enviado!", "status" => "success"]);
        
    }

    public function gerarPdfProposta($proposta)
    {

        if (!$proposta) {
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }

        $pdf = PDF::loadView('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta)]);
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'pdfTabelaPropostas.pdf');
    }

    public function adjudicarProposta($proposta)
    {
       //Carrinho::where('id_cliente', $proposta["number"])->where("id_user", Auth::user()->id)->delete();
       //ComentariosProdutos::where('no', $proposta["number"])->where("id_user", Auth::user()->id)->delete();
        foreach($proposta["lines"] as $prop)
        {
         
            Carrinho::create([
                "id_proposta" => "",
                "id_encomenda" => $proposta["id"],
                "id_cliente" => $proposta["number"],
                "id_user" => Auth::user()->id,
                "referencia" => $prop["reference"],
                "designacao" => $prop["description"],
                "price" => $prop["price"],
                "discount" => $prop["discount"],
                "discount2" => $prop["discount2"],
                "qtd" => $prop["quantity"],
                "iva" => 12,
                "pvp" => $prop["pvp"],
                "model" => $prop["model"],
                "image_ref" => "https://storage.sanipower.pt/storage/produtos/".$prop["family_number"]."/".$prop["family_number"]."-".$prop["subfamily_number"]."-".$prop["product_number"].".jpg",
                "proposta_info" => $proposta["budget"],
            ]);
        }

        
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro(10,1,"",$proposta["number"],"","","","");


        session()->flash("success", "Proposta adjudicada com sucesso");
        return redirect()->route('encomendas.detail',["id" => $this->clientes[0]->id]);
      

    }

    public function openComentario($idProposta)
    {
        $this->propostaComentarioId = $idProposta;

        $this->dispatchBrowserEvent('openComentario');
    }

    public function sendComentario($idProposta)
    {
        if (empty($this->comentarioEncomenda)) {
            $message = "O campo de comentário está vazio!";
            $status = "error";
        } else {
            $response = $this->clientesRepository->sendComentarios($idProposta, $this->comentarioEncomenda, "propostas");

            $responseArray = $response->getData(true);

            if ($responseArray["success"] == true) {
                $message = "Comentário adicionado com sucesso!";
                $status = "success";
            } else {
                $message = "Não foi possível adicionar o comentário!";
                $status = "error";
            }
        }
        
        // Reinicia os detalhes da encomenda
        $this->comentarioEncomenda = "";
        // Exibe a mensagem usando o evento do navegador
        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);
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
   
    
    public function render()
    {
        $proposta = session('proposta');
        $comentario = Comentarios::with('user')->where('stamp', $proposta->id)->where('tipo', 'propostas')->orderBy('id','DESC')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;
        
        $this->proposta = session()->get('proposta');
        foreach ($this->proposta->lines as $prod){
            $image_ref = "https://storage.sanipower.pt/storage/produtos/".$prod->family_number."/".$prod->family_number."-".$prod->subfamily_number."-".$prod->product_number.".jpg";
            $prod->image_ref = $image_ref;
        }
   
        $imagens = [];
        foreach($this->proposta->lines as $carrinho){
            array_push($imagens,$carrinho->image_ref);
        }
        
        $iamgens_unique = array_unique($imagens);


        $arrayCart = [];

        foreach ($iamgens_unique as $img) {
            $arrayCart[$img] = [];
            foreach ($this->proposta->lines as $cart) {
                if ($img == $cart->image_ref) {
                    $found = false;
                    foreach ($arrayCart[$img] as $item) {
                        if ($item->reference == $cart->reference) {
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
        
        $proposta = session()->get('proposta');
        return view('livewire.propostas.proposta-info',["proposta" => $proposta, "arrayCart" =>$arrayCart]);

    }
}
