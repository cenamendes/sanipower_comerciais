<?php

namespace App\Http\Livewire\Visitas;

use App\Models\User;
use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Interfaces\VisitasInterface;
use App\Models\TiposVisitas;
use Livewire\WithPagination;


class Visitas extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    private ?object $visitasRepository = NULL;
    protected ?object $clientes = NULL;

    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';

    public ?object $tipoVisita = NULL;
    public ?string $nomeClienteVisitaTemp = "";
    public ?string $idClienteVisitaTemp = "";

    //Parte do Modal da Visita
    public ?string $dataInicial = "";
    public ?string $horaInicial = "";
    public ?string $horaFinal = "";
    public ?string $tipoVisitaEscolhido = "";


    public function boot(ClientesInterface $clientesRepository, VisitasInterface $visitasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->visitasRepository = $visitasRepository;
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

        $this->nomeCliente = '';
        $this->numeroCliente = '';
        $this->zonaCliente = '';
        $this->telemovelCliente = '';
        $this->emailCliente = '';
        $this->nifCliente = '';
        
        $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
        $getInfoClientes = $this->clientesRepository->getNumberOfPages($this->perPage);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];

    }


    public function mount()
    {
        $this->initProperties();
    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesClienteFiltro($this->perPage,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
            $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
        } else {
            $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
                $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
            } else {
                $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
                $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
            } else {
                $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
                $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
            } else {
                $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            }
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

    public function updatedPerPage(): void
    {
        $this->resetPage();
        session()->put('perPage', $this->perPage);

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
            $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
            $getInfoClientes = $this->clientesRepository->getNumberOfPages($this->perPage);

            $this->numberMaxPages = $getInfoClientes["nr_paginas"];
            $this->totalRecords = $getInfoClientes["nr_registos"];
        } else {
            $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            $getInfoClientes = $this->clientesRepository->getNumberOfPages($this->perPage);

            $this->numberMaxPages = $getInfoClientes["nr_paginas"];
            $this->totalRecords = $getInfoClientes["nr_registos"];
        }

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function agendarVisita($clientID,$nome)
    {
        $this->initProperties();

        $this->nomeClienteVisitaTemp = $nome;

        $this->idClienteVisitaTemp = $clientID;

        $this->tipoVisita = TiposVisitas::all();

        $this->dispatchBrowserEvent('modalAgendar',["clienteid" => $clientID, "nome" => $nome]);
    }

    public function newVisita($idClienteVisitaTemp)
    {
        $this->initProperties();

        if($this->dataInicial == "" ||$this->horaInicial == "" || $this->horaFinal == "" || $this->tipoVisitaEscolhido == "" )
        {
            $this->dispatchBrowserEvent('openToastMessage', ["message" => "Tem de preencher todos os campos", "status" => "error"]);
            return false;
        }

        if(strtotime($this->horaInicial) > strtotime($this->horaFinal))
        {
            $this->dispatchBrowserEvent('openToastMessage', ["message" => "Hora final tem de ser superior á hora inicial", "status" => "error"]);
            return false;
        }

        $response = $this->visitasRepository->addVisitaDatabase($idClienteVisitaTemp, $this->dataInicial, $this->horaInicial, $this->horaFinal, $this->tipoVisitaEscolhido);

        $responseArray = $response->getData(true);

        if ($responseArray["success"] == true) {
            $message = "Visita agendada com sucesso";
            $status = "success";
        } else {
            $message = "Não foi possivel adicionar a visita!";
            $status = "error";
        }

        $this->emit('reloadNotification');
      
        $this->dispatchBrowserEvent('openToastMessage', ["message" => $message, "status" => $status]);
        
    }

        
    public function render()
    {
        return view('livewire.visitas.visitas',["clientes" => $this->clientes]);
    }
}
