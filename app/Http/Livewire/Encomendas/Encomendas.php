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

    public $estadoEncomenda = "";

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
        $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        $this->totalRecords = $getInfoClientes["nr_registos"];


    }

   
    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        // $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);

        // $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
        // $this->totalRecords = $getInfoClientes["nr_registos"];

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }

    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;

        // if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
        //     $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        // } else {
        //     $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        // }

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

         

            $arrayEncomendas = [];
        
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }

         
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                //$this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
        

          
            //$this->totalRecords = count($arrayEncomendas);
        
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;

            // if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            //     $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            // } else {
            //     $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            // }

            if($this->estadoEncomenda != "")
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                    $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                } else {
                    $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                }
    
                $arrayEncomendas = [];
        
                foreach($encomendas as $enc)
                {
                    if($this->estadoEncomenda == 1)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario != null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    elseif($this->estadoEncomenda == 2)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario == null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    else
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
              
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
                if($arrayEncomendas != null)
                {
                    $contaPaginas = count($arrayEncomendas) / $this->perPage;
                    $this->numberMaxPages = floor($contaPaginas);
                    $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
        
                    $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
        
                }
                else {
                
                    $currentItems = [];
                    $this->numberMaxPages = 0;
                    $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
                }
        
                
                $this->totalRecords = count($arrayEncomendas);
        
                $this->encomendas = $itemsPaginate;
            }
            else 
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
    
                    $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                } else {
                    $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                }
            }
        }
        else if($this->pageChosen == 1){
            // if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            //     $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            // } else {
            //     $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            // }

            if($this->estadoEncomenda != "")
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                    $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                } else {
                    $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                }
    
                $arrayEncomendas = [];
        
                foreach($encomendas as $enc)
                {
                    if($this->estadoEncomenda == 1)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario != null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    elseif($this->estadoEncomenda == 2)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario == null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    else
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
              
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
                if($arrayEncomendas != null)
                {
                    $contaPaginas = count($arrayEncomendas) / $this->perPage;
                    $this->numberMaxPages = floor($contaPaginas) + 1;
                    $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
        
                    $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
        
                }
                else {
                
                    $currentItems = [];
                    $this->numberMaxPages = 0;
                    $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
                }
        
                
                $this->totalRecords = count($arrayEncomendas);
        
                $this->encomendas = $itemsPaginate;
            }
            else 
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
    
                    $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                } else {
                    $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                }
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            // if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            //     $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        
            // } else {
            //     $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            // }

            if($this->estadoEncomenda != "")
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                    $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                } else {
                    $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                }
    
                $arrayEncomendas = [];
        
                foreach($encomendas as $enc)
                {
                    if($this->estadoEncomenda == 1)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario != null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    elseif($this->estadoEncomenda == 2)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
        
                        if($checkComentario == null)
                        {
                            array_push($arrayEncomendas,$enc);
                        }
                    }
                    else
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
              
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
                if($arrayEncomendas != null)
                {
                    $contaPaginas = count($arrayEncomendas) / $this->perPage;
                    $this->numberMaxPages = floor($contaPaginas) + 1;
                    $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
        
                    $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
        
                }
                else {
                
                    $currentItems = [];
                    $this->numberMaxPages = 0;
                    $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
                }
        
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                    $verifyNumber = $this->clientesRepository->getEncomendasClienteFiltro(999999,1,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                } else {
                    $verifyNumber = $this->clientesRepository->getEncomendasCliente(9999999,1,$this->idCliente);
                }

                $arrayVerify = [];

                foreach($verifyNumber as $enc)
                {
                    if($this->estadoEncomenda == 1)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();

                        if($checkComentario != null)
                        {
                            array_push($arrayVerify,$enc);
                        }
                    }
                    elseif($this->estadoEncomenda == 2)
                    {
                        $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();

                        if($checkComentario == null)
                        {
                            array_push($arrayVerify,$enc);
                        }
                    }
                    else
                    {
                        array_push($arrayVerify,$enc);
                    }
                }
      
                $this->totalRecords = count($arrayVerify);
        
                $this->encomendas = $itemsPaginate;
            }
            else 
            {
                if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
    
                    $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                } else {
                    $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                    $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
        
                    $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                    $this->totalRecords = $getInfoClientes["nr_registos"];
                }
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

        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }

            $arrayEncomendas = [];
    
            foreach($encomendas as $enc)
            {
                if($this->estadoEncomenda == 1)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario != null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                elseif($this->estadoEncomenda == 2)
                {
                    $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();
    
                    if($checkComentario == null)
                    {
                        array_push($arrayEncomendas,$enc);
                    }
                }
                else
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
          
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
    
            if($arrayEncomendas != null)
            {
                $contaPaginas = count($arrayEncomendas) / $this->perPage;
                $this->numberMaxPages = floor($contaPaginas);
                $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);
    
                $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);
    
            }
            else {
            
                $currentItems = [];
                $this->numberMaxPages = 0;
                $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
            }
    
            
            $this->totalRecords = count($arrayEncomendas);
    
            $this->encomendas = $itemsPaginate;
        }
        else 
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){

                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro($this->perPage,$this->pageChosen,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasFiltro($this->perPage,$this->idCliente,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
                $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);
    
                $this->numberMaxPages = $getInfoClientes["nr_paginas"] + 1;
                $this->totalRecords = $getInfoClientes["nr_registos"];
            }
        }
       

    }

    public function checkOrder($idEncomenda)
    {
        if($this->estadoEncomenda != "")
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro(9999999,$this->pageChosen,"",$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
            }
        }
        else
        {
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro(9999999,$this->pageChosen,"",$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            } else {
                $this->encomendas = $this->clientesRepository->getEncomendasCliente(999999,$this->pageChosen,"");
            }
        }

        foreach($this->encomendas as $enc)
        {
            if($enc->id == $idEncomenda)
            {
                Session::put('encomenda', $enc);
                return redirect()->route('encomendas.encomenda', ['idEncomenda' => $idEncomenda]);
            }
        }
    }

    public function updatedEstadoEncomenda()
    {
        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $this->encomendas = $this->clientesRepository->getEncomendasClienteFiltro(9999999,$this->pageChosen,"",$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        
        } else {
            $this->encomendas = $this->clientesRepository->getEncomendasCliente(9999999,$this->pageChosen,"");
        }

        $arrayEncomendas = [];

        foreach($this->encomendas as $enc)
        {
            if($this->estadoEncomenda == 1)
            {
                $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();

                if($checkComentario != null)
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
            elseif($this->estadoEncomenda == 2)
            {
                $checkComentario = Comentarios::where('tipo','encomendas')->where('stamp',$enc->id)->first();

                if($checkComentario == null)
                {
                    array_push($arrayEncomendas,$enc);
                }
            }
            else
            {
                array_push($arrayEncomendas,$enc);
            }
        }


      
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($arrayEncomendas != null)
        {
            $contaPaginas = count($arrayEncomendas) / $this->perPage;
            $this->numberMaxPages = floor($contaPaginas) + 1;
            $currentItems = array_slice($arrayEncomendas, $this->perPage * ($currentPage - 1), $this->perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems,floor($contaPaginas),$this->perPage);

        }
        else {
        
            $currentItems = [];
            $this->numberMaxPages = 0;
            $itemsPaginate = new LengthAwarePaginator($currentItems, 0,$this->perPage);
        }

        
        $this->totalRecords = count($arrayEncomendas);

        $this->encomendas = $itemsPaginate;

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
