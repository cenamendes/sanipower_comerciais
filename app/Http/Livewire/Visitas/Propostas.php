<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;
use App\Models\Comentarios;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class Propostas extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $propostasDetail = NULL;
    public ?string $propostaID = "";
    public ?string $propostaName = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    public ?string $comentarioProposta = "";

    private ?object $detailsPropostas = NULL;
    public ?object $comentario = NULL;

    public $estadoProposta = "";


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
        $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
        else if($this->pageChosen == 1){
            $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
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

    public function updatedEstadoProposta()
    {
        $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }

    public function restartDetails()
    {
        $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

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

        $this->propostaID = $id;
        $this->propostaName = $name;

        $this->comentarioProposta = "";

        $this->dispatchBrowserEvent('openComentarioModalPropostas');

    }

    public function sendComentario($idProposta)
    {
        if (empty($this->comentarioProposta)) {
            $message = "O campo de comentário está vazio!";
            $status = "error";
        } else {
        $response = $this->clientesRepository->sendComentarios($idProposta,$this->comentarioProposta, "propostas");

        $responseArray = $response->getData(true);

        if($responseArray["success"] == true){
            $message = "Comentário adicionado com sucesso!";
            $status = "success";
         } else {
             $message = "Não foi possivel adicionar o comentário!";
             $status = "error";
         }

        }

        $this->restartDetails();

        $this->dispatchBrowserEvent('checkToaster',["message" => $message, "status" => $status]);
    }


    public function gerarPdfProposta($propostaID, $proposta)
    {
        if (!$proposta) {
            return redirect()->back()->with('error', 'Proposta não encontrada.');
        }
        foreach ($proposta['data'] as $oneProposta) {
            if ($oneProposta['id'] === $propostaID) {
                $proposta = $oneProposta;
            }
        }

        foreach ($proposta['lines'] as $index => $prod) {
            $image_ref = "https://storage.sanipower.pt/storage/produtos/".$prod['family_number']."/".$prod['family_number']."-".$prod['subfamily_number']."-".$prod['product_number'].".jpg";
            $proposta['lines'][$index]['image_ref'] = $image_ref;
        }

        $pdf = PDF::loadView('pdf.pdfTabelaPropostas', ["proposta" => json_encode($proposta)]);

        $this->dispatchBrowserEvent('checkToaster');

        $this->restartDetails();


        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'pdfTabelaPropostas.pdf');
    }

    public function verComentario($idProposta)
    {
        // Carrega o comentário correspondente
        $comentario = Comentarios::with('user')->where('stamp', $idProposta)->where('tipo', 'propostas')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;

        $this->restartDetails();
        // Dispara o evento para abrir o modal
        $this->dispatchBrowserEvent('abrirModalVerComentarioProposta');
    }

    public function detalhePropostaModal($id)
    {

        $this->propostaID = $id;

        $this->comentarioProposta = "";

        $this->restartDetails();

        $this->dispatchBrowserEvent('openDetalhePropostaModal');
    }

    public function render()
    {
        return view('livewire.visitas.propostas',["detalhesPropostas" => $this->detailsPropostas]);
    }
}
