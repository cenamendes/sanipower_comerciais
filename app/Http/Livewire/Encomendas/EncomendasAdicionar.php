<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;

class EncomendasAdicionar extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;

    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';
    

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

        $this->nomeCliente = '';
        $this->numeroCliente = '';
        $this->zonaCliente = '';
        $this->telemovelCliente = '';
        $this->emailCliente = '';
        $this->nifCliente = '';

    }

    public function mount()
    {
        $this->initProperties();

        $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
        $this->clientes = $arrayClientes["paginator"];
     

        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];


    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        $this->clientes = $arrayClientes["paginator"];
        $this->numberMaxPages = $arrayClientes["nr_paginas"];
        $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            $this->clientes = $arrayClientes["paginator"];
        } else {
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            $this->clientes = $arrayClientes["paginator"];
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                $this->clientes = $arrayClientes["paginator"];
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                $this->clientes = $arrayClientes["paginator"];
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                $this->clientes = $arrayClientes["paginator"];
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

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            $this->clientes = $arrayClientes["paginator"];

            $this->numberMaxPages = $arrayClientes["nr_paginas"];
            $this->totalRecords = $arrayClientes["nr_registos"];
        } else {
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            $this->clientes = $arrayClientes["paginator"];
        

            $this->numberMaxPages = $arrayClientes["nr_paginas"];
            $this->totalRecords = $arrayClientes["nr_registos"];
        }

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

        
    public function render()
    {
        return view('livewire.encomendas.encomendas-adicionar',["clientes" => $this->clientes]);
    }
}
