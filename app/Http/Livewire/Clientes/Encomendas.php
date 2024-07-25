<?php

namespace App\Http\Livewire\Clientes;

use Dompdf\Dompdf;
use Livewire\Component;
use App\Mail\SendEncomenda;
use App\Models\Comentarios;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;

class Encomendas extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $encomendasDetail = NULL;
    public ?string $encomendaID = "";
    public ?string $encomendaName = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    public ?string $comentarioEncomenda = "";

    private ?object $detailsEncomenda = NULL;
    public ?object $comentario = NULL;

    public $estadoEncomenda = "";

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }

    private function initProperties(): void
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

        //$this->idCliente = "AJ19073058355,4450000-1";

        $this->restartDetails();

    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
        else if($this->pageChosen == 1){
            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
    }

    public function getPageRange()
    {
        $currentPage = $this->pageChosen;
        $lastPage = $this->numberMaxPages;

        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);


        return range($start, $end);
    }

    public function isCurrentPage($page)
    {
        return $page == $this->pageChosen;
    }

    public function updatedperPage(): void
    {
        $this->resetPage();
        session()->put('perPage', $this->perPage);


        $this->restartDetails();

    }
    public function updatedEstadoEncomenda()
    {
        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }
    public function restartDetails()
    {
        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function comentarioModal($id,$name)
    {
        $this->restartDetails();

        $this->encomendaID = $id;
        $this->encomendaName = $name;

        $this->comentarioEncomenda = "";

        $this->dispatchBrowserEvent('openComentarioModal');

    }

    public function sendComentario($idEncomenda)
    {
        if (empty($this->comentarioEncomenda)) {
            $message = "O campo de comentário está vazio!";
            $status = "error";
        } else {
            $response = $this->clientesRepository->sendComentarios($idEncomenda, $this->comentarioEncomenda, "encomendas");

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
        $this->restartDetails();

        // Exibe a mensagem usando o evento do navegador
        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);
    }

    public function gerarPdfEncomenda($encomendaID, $encomenda)
    {
        if (!$encomenda) {
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }
        foreach ($encomenda['data'] as $oneEncomenda) {
            if ($oneEncomenda['id'] === $encomendaID) {
                $encomenda = $oneEncomenda;
            }
        }

        foreach ($encomenda['lines'] as $index => $prod) {
            $image_ref = "https://storage.sanipower.pt/storage/produtos/".$prod['family_number']."/".$prod['family_number']."-".$prod['subfamily_number']."-".$prod['product_number'].".jpg";
            $encomenda['lines'][$index]['image_ref'] = $image_ref;
        }

        $pdf = PDF::loadView('pdf.pdfTabelaEncomenda', ["encomenda" => json_encode($encomenda)]);

        $this->dispatchBrowserEvent('checkToaster');

        $this->restartDetails();


        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'pdfTabelaEncomenda.pdf');
    }

    public function verComentario($idEncomenda)
    {
        // Carrega o comentário correspondente
        $comentario = Comentarios::with('user')->where('stamp', $idEncomenda)->where('tipo', 'encomendas')->orderBy('id','DESC')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;

        $this->restartDetails();
        // Dispara o evento para abrir o modal
        $this->dispatchBrowserEvent('abrirModalVerComentario');
    }

    public function detalheEncomendaModal($encomenda)
    {

        Session::put('rota','clientes.detail');
        Session::put('parametro',$this->idCliente);

        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);

        

        foreach($this->detailsEncomenda as $det)
        {
            if($det->id == $encomenda["id"])
            {
                $propSend = $det;
            }
        }

        

        Session::put('encomenda',$propSend);

        return redirect()->route('encomendas.encomenda',["idEncomenda" => $propSend->id]);

    }
        
    //     $this->encomendaID = $id;

    //     $this->restartDetails();

    //     $this->dispatchBrowserEvent('openDetalheEncomendaModal');
    // }

    public function enviarEmail($detalheEncomenda,$encomendaID)
    {
        dd("Erro");
        foreach($detalheEncomenda["data"] as $pr)
        {
            if($encomendaID == $pr["id"])
            {
                $encomenda = $pr;
            }
        }

        if (!$encomenda) {
            dd("Não há valor na variável \$proposta");
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }

 
        $pdf = new Dompdf();
        $pdf = PDF::loadView('pdf.pdfTabelaEncomenda', ["encomenda" => json_encode($encomenda)]);
    
        $pdf->render();
    
        $pdfContent = $pdf->output();
    
           
        try {
            // Mail::to(Auth::user()->email)->send(new SendEncomenda($pdfContent));
            $this->dispatchBrowserEvent('checkToaster', ["message" => "Email enviado!", "status" => "success"]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('checkToaster', ["message" => $e->getMessage(), "status" => "warning"]);
        }

        $this->restartDetails();
    }

    public function render()
    {
        return view('livewire.clientes.encomendas',["detalhesEncomenda" => $this->detailsEncomenda]);
    }
}
