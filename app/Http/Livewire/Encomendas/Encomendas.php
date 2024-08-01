<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use App\Models\Comentarios;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class Encomendas extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    protected ?object $encomendas = NULL;

    public ?array $encomendasByClient = NULL;

    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';
    
    public $idCliente;

    public $estadoEncomenda = "0";

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

        $this->idCliente = '';

    }

    public function mount()
    {
        $this->initProperties();

        $encomendasArray = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        
        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

        


    }

   
    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

    }


    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];
    }

    public function updatedEstadoEncomenda()
    {
        $this->pageChosen = 1;
        $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

        $this->encomendas = $encomendasArray["paginator"];
        $this->numberMaxPages = $encomendasArray["nr_paginas"];
        $this->totalRecords = $encomendasArray["nr_registos"];

    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;
 
        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoEncomenda != "0"){
            $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
            $this->encomendas = $encomendasArray["paginator"];
        } else {
            $encomendasArray = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            $this->encomendas = $encomendasArray["paginator"];
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoEncomenda != "0"){
                $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
                $this->encomendas = $encomendasArray["paginator"];
            } else {
                $encomendasArray =  $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->encomendas = $encomendasArray["paginator"];
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoEncomenda != "0"){
                $encomendasArray =  $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
                $this->encomendas = $encomendasArray["paginator"];
            } else {
                $encomendasArray = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->encomendas = $encomendasArray["paginator"];
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoEncomenda != "0"){
                $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
                $this->encomendas = $encomendasArray["paginator"];
            } else {
                $encomendasArray = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->encomendas = $encomendasArray["paginator"];
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

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoEncomenda != "0"){
            $encomendasArray = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoEncomenda);
       

            $this->encomendas = $encomendasArray["paginator"];
            $this->numberMaxPages = $encomendasArray["nr_paginas"];
            $this->totalRecords = $encomendasArray["nr_registos"];
        } else {
            
            $encomendasArray = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        
            $this->encomendas = $encomendasArray["paginator"];
            $this->numberMaxPages = $encomendasArray["nr_paginas"];
            $this->totalRecords = $encomendasArray["nr_registos"];
        }
        

    }

    public function checkOrder($idEncomenda, $encomenda)
    {
        // if($this->estadoEncomenda != "")
        // {
        //     $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro(9999999,$this->pageChosen,"",$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
        // } else {
        //     $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        // }
     

        // foreach($this->encomendas as $enc)
        // {
        //     if($enc->id == $idEncomenda)
        //     {

        $json = json_encode($encomenda);
        $object = json_decode($json, false);

                Session::put('rota','encomendas');
                Session::put('encomenda', $object);
                return redirect()->route('encomendas.encomenda', ['idEncomenda' => $idEncomenda]);
        //     }
        // }
    }

    public function adicionarEncomenda()
    {
        Session::forget('encomenda');
        return redirect()->route('encomendas.nova');
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

        
    public function render()
    {
        return view('livewire.encomendas.encomendas',["encomendas" => $this->encomendas]);
    }
}
