<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;

class NewVisita extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    private ?object $detailsClientes = NULL;
    private ?object $analysisClientes = NULL;

    public string $tabDetail = "show active";
    public string $tabAnalysis = "";

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
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);
        
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesAnalisesCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    
    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
        $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);
    
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
    }

   
    public function previousPage()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
        else if($this->pageChosen == 1){
            $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
    }

    public function nextPage()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;
            $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
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

        $this->tabDetail = "";
        $this->tabAnalysis = "show active";

        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        $this->analysisClientes = $this->clientesRepository->getListagemAnalisesCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $getInfoClientes = $this->clientesRepository->getNumberOfPagesAnalisesCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    
    public function paginationView()
    {
        return 'livewire.pagination';
    }



    public function render()
    {
        return view('livewire.visitas.new-visitas',["detalhesCliente" => $this->detailsClientes, "analisesCliente" =>$this->analysisClientes]);
    }
}
