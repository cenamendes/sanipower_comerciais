<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;
use App\Models\Comentarios;
use Illuminate\Support\Facades\Session;

class Ocorrencias extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $ocorrenciasDetail = NULL;
    public ?string $ocorrenciaID = "";
    public ?string $ocorrenciaName = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;


    public string $assunto = "";
    public string $relatorio = "";
    public string $pendentes = "";
    public string $comentario_encomendas = "";
    public string $comentario_propostas = "";
    public string $comentario_financeiro = "";
    public string $comentario_occorencias = "";
    public int $tipoVisitaSelect;
    public int $checkStatus;

    public ?string $comentarioOcorrencia = "";

    private ?object $detailsOcorrencias = NULL;
    public ?object $comentario = NULL;
    public $detailsLine = NULL;


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

        if(session('visitasPropostasComentario_occorencias')){
            $this->comentario_occorencias = session('visitasPropostasComentario_occorencias');
        }
        if(session('visitasPropostasCheckStatus')){
            $this->checkStatus = session('visitasPropostasCheckStatus');
        }

        $this->restartDetails();

    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        // $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $this->detailsOcorrencias = $ocorrenciasArray["object"];
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsOcorrencias = $ocorrenciasArray["object"];
        }
        else if($this->pageChosen == 1){
            $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsOcorrencias = $ocorrenciasArray["object"];
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsOcorrencias = $ocorrenciasArray["object"];
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

    public function restartDetails()
    {
        $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $this->detailsOcorrencias = $ocorrenciasArray["object"];

        $this->numberMaxPages = $ocorrenciasArray["nr_paginas"] + 1;
        $this->totalRecords = $ocorrenciasArray["nr_registos"];

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function comentarioModal($id,$name)
    {
        $this->restartDetails();

        $this->ocorrenciaID = $id;
        $this->ocorrenciaName = $name;

        $this->comentarioOcorrencia = "";

        $this->dispatchBrowserEvent('openComentarioModalOcorrencias');

    }

    public function sendComentario($idProposta)
    {
        if (empty($this->comentarioOcorrencia)) {
            $message = "O campo de comentário está vazio!";
            $status = "error";
        } else {
        $response = $this->clientesRepository->sendComentarios($idProposta,$this->comentarioOcorrencia, "ocorrencias");

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


    public function verComentario($idProposta)
    {
        // Carrega o comentário correspondente
        $comentario = Comentarios::with('user')->where('stamp', $idProposta)->where('tipo', 'ocorrencias')->orderBy('id','DESC')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;

        $this->restartDetails();
        // Dispara o evento para abrir o modal
        $this->dispatchBrowserEvent('abrirModalVerComentarioOcorrencias');
    }

    public function detalheOcorrenciasModal($details)
    {
        $this->ocorrenciaID = $details['id'];
        $this->detailsLine = $details;

        $this->restartDetails();

        $this->dispatchBrowserEvent('openDetalheOcorrenciasModal');
        
    }
    public function render()
    {
        $ocorrenciasArray = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $this->detailsOcorrencias = $ocorrenciasArray["object"];

        Session::put('visitasPropostasComentario_occorencias', $this->comentario_occorencias );
        return view('livewire.visitas.ocorrencias',["detalhesOcorrencias" => $this->detailsOcorrencias]);
    }
}
