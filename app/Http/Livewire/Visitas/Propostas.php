<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;

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

        $this->idCliente = "AJ19073058355,4450000-1";

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

    public function restartDetails()
    {
        $this->detailsPropostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
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
        $response = $this->clientesRepository->sendComentariosPropostas($idProposta,$this->comentarioProposta);

        $responseArray = $response->getData(true);
        
        if($responseArray["success"] == true){
            $message = "Comentário adicionado com sucesso!";
            $status = "success";
         } else {
             $message = "Não foi possivel adicionar o comentário!";
             $status = "error";
         }

        $this->restartDetails();

        $this->dispatchBrowserEvent('checkToaster',["message" => $message, "status" => $status]);
    }


    public function render()
    {
        return view('livewire.visitas.propostas',["detalhesPropostas" => $this->detailsPropostas]);
    }
}
