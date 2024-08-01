<?php

namespace App\Http\Livewire\Propostas;

use Livewire\Component;
use App\Models\Comentarios;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class Propostas extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    protected ?object $propostas = NULL;

    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';

    public $idCliente;

    public $estadoProposta = "0";
    

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
        $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        // $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);
        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];

        
    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    }

    public function updatedEstadoProposta()
    {
        $this->pageChosen = 1;
        $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

        $this->propostas = $propostasArray["paginator"];
        $this->numberMaxPages = $propostasArray["nr_paginas"];
        $this->totalRecords = $propostasArray["nr_registos"];
    
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoProposta != "0"){
            $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
            $this->propostas = $propostasArray["paginator"];
        } else {
            $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            $this->propostas = $propostasArray["paginator"];
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoProposta != "0"){
                $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
                $this->propostas = $propostasArray["paginator"];
            } else {
                $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->propostas = $propostasArray["paginator"];
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoProposta != "0"){
                $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
                $this->propostas = $propostasArray["paginator"];
            } else {
                $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->propostas = $propostasArray["paginator"];
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoProposta != "0"){
                $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
                $this->propostas = $propostasArray["paginator"];
            } else {
                $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $this->propostas = $propostasArray["paginator"];
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

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != "" || $this->estadoProposta != "0"){
            // $this->propostas = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
            // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasFiltro($this->perPage,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);

            // $this->numberMaxPages = $getInfoClientes["nr_paginas"];
            // $this->totalRecords = $getInfoClientes["nr_registos"];

            $propostasArray = $this->clientesRepository->getPropostasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente,$this->estadoProposta);
          
            $this->propostas = $propostasArray["paginator"];
            $this->numberMaxPages = $propostasArray["nr_paginas"];
            $this->totalRecords = $propostasArray["nr_registos"];
        } else {
            $propostasArray = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
           
            $this->propostas = $propostasArray["paginator"];
            $this->numberMaxPages = $propostasArray["nr_paginas"];
            $this->totalRecords = $propostasArray["nr_registos"];
           
            // $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

            // $this->numberMaxPages = $getInfoClientes["nr_paginas"];
            // $this->totalRecords = $getInfoClientes["nr_registos"];
        }
        

    }

    public function adicionarProposta()
    {
        Session::forget('proposta');
        return redirect()->route('propostas.nova');
    }

    public function checkOrder($idProposta, $proposta)
    {
        // if($this->estadoProposta != "0")
        // {
        //     $this->propostas = $this->clientesRepository->getPropostasCliente(999999,$this->pageChosen,"");
        // } 
        // else 
        // {   
        //     $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        // }
       
       
        // foreach($this->propostas as $enc)
        // {
        //     dD($enc);
        //     if($enc->id == $idProposta)
        //     {
          $json = json_encode($proposta);
          $object = json_decode($json, false);

      
                Session::put('proposta', $object);
                Session::put('rota','propostas');
                return redirect()->route('propostas.proposta', ['idProposta' => $idProposta]);
        //     }
        // }
    }


    public function paginationView()
    {
        return 'livewire.pagination';
    }

        
    public function render()
    {
        return view('livewire.propostas.propostas',["propostas" => $this->propostas]);
    }
}
