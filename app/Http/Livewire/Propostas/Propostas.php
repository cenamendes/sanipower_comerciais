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
        $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);


        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];


    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;

        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        } else {
            $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            } else {
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            } else {
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
            } else {
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
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

        if($this->estadoProposta != "")
        {
            $propostas = $this->clientesRepository->getPropostasCliente(9999999,$this->pageChosen,"");

            $arrayPropostas = [];
    
            foreach($propostas as $enc)
            {
                if($this->estadoProposta == 1)
                {
                    $checkComentario = Comentarios::where('tipo','propostas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayPropostas,$enc);
                    }
                }
                elseif($this->estadoProposta == 2)
                {
                    $checkComentario = Comentarios::where('tipo','propostas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayPropostas,$enc);
                    }
                }
                else
                {
                    array_push($arrayPropostas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayPropostas != null)
            {
                $contaPaginas = count($arrayPropostas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayPropostas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayPropostas);
    
            $this->propostas = $itemsPaginate;
        }
        else
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
    
                $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen, $this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesPropostasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }
        

    }

    public function adicionarProposta()
    {
        Session::forget('proposta');
        return redirect()->route('propostas.nova');
    }

    public function checkOrder($idProposta)
    {
        if($this->estadoProposta != "")
        {
            $this->propostas = $this->clientesRepository->getPropostasCliente(999999,$this->pageChosen,"");
        } 
        else 
        {
            $this->propostas = $this->clientesRepository->getPropostasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
       
       
        foreach($this->propostas as $enc)
        {
            if($enc->id == $idProposta)
            {
               
                Session::put('proposta', $enc);
                Session::put('rota','propostas');
                return redirect()->route('propostas.proposta', ['idProposta' => $idProposta]);
            }
        }
    }

    public function updatedEstadoProposta()
    {
        $propostas = $this->clientesRepository->getPropostasCliente(9999999,$this->pageChosen,"");

        $arrayPropostas = [];

        foreach($propostas as $enc)
        {
            if($this->estadoProposta == 1)
            {
                $checkComentario = Comentarios::where('tipo','propostas')->where('stamp',$enc->id)->first();

                if($checkComentario != null)
                {
                    array_push($arrayPropostas,$enc);
                }
            }
            elseif($this->estadoProposta == 2)
            {
                $checkComentario = Comentarios::where('tipo','propostas')->where('stamp',$enc->id)->first();

                if($checkComentario == null)
                {
                    array_push($arrayPropostas,$enc);
                }
            }
            else
            {
                array_push($arrayPropostas,$enc);
            }
        }
      
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($arrayPropostas != null)
        {
            $contaPaginas = count($arrayPropostas) / $this->perPage;
            $this->numberMaxPages = floor($contaPaginas);
            $currentItems = array_slice($arrayPropostas, $this->perPage * ($currentPage - 1), $this->perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);

        }
        else {
        
            $currentItems = [];
            $this->numberMaxPages = 0;
            $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
        }

        
        $this->totalRecords = count($arrayPropostas);

        $this->propostas = $itemsPaginate;

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
