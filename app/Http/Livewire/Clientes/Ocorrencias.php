<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;
use App\Models\Comentarios;

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

    public ?string $comentarioOcorrencia = "";

    private ?object $detailsOcorrencias = NULL;
    public ?object $comentario = NULL;

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
        $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
        else if($this->pageChosen == 1){
            $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
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
        $this->detailsOcorrencias = $this->clientesRepository->getOcorrenciasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesOcorrenciasCliente($this->perPage,$this->idCliente);

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
        $comentario = Comentarios::with('user')->where('stamp', $idProposta)->where('tipo', 'ocorrencias')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;

        $this->restartDetails();
        // Dispara o evento para abrir o modal
        $this->dispatchBrowserEvent('abrirModalVerComentarioOcorrencias');
    }

    public function detalheOcorrenciasModal($id)
    {

        $this->ocorrenciaID = $id;

        $this->restartDetails();

        $this->dispatchBrowserEvent('openDetalheOcorrenciasModal');
        
    }
    public function render()
    {
        return view('livewire.clientes.ocorrencias',["detalhesOcorrencias" => $this->detailsOcorrencias]);
    }
}
