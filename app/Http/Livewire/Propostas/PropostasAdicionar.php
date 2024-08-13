<?php

namespace App\Http\Livewire\Propostas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;


class PropostasAdicionar extends Component
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

        // $this->nomeCliente = '';
        // $this->numeroCliente = '';
        // $this->zonaCliente = '';
        // $this->telemovelCliente = '';
        // $this->emailCliente = '';
        // $this->nifCliente = '';


        $this->nomeCliente = session('AdiPropostaNomeCliente');
        $this->numeroCliente = session('AdiPropostaNumeroCliente');
        $this->zonaCliente = session('AdiPropostaZonaCliente');
        $this->telemovelCliente = session('AdiPropostaTelemovelCliente');
        $this->emailCliente = session('AdiPropostaEmailCliente');
        $this->nifCliente = session('AdiPropostaNifCliente');
    }

    public function mount()
    {
        $this->initProperties();
        // Session::forget('AdiPropostaPaginator');
        // dd(session('AdiPropostaPaginator'));
        if(session('AdiPropostaPaginator')){
            $this->clientes = session('AdiPropostaPaginator');
            
            if(session('AdiPropostaNr_paginas') == 0 || session('AdiPropostaNr_paginas')){
                
                $this->numberMaxPages = session('AdiPropostaNr_paginas');
                
            }
            if(session('AdiPropostaNr_registos')){
                $this->totalRecords = session('AdiPropostaNr_registos');
            }
            if(session('AdiPropostaPageChosen')){
                $this->pageChosen = session('AdiPropostaPageChosen');
            }
        }else{
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
            Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
            Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);
            
    

            $this->clientes = session('AdiPropostaPaginator');
            $this->numberMaxPages = session('AdiPropostaNr_paginas');
            $this->totalRecords = session('AdiPropostaNr_registos');


            // $this->clientes = $arrayClientes["paginator"];
            // $this->numberMaxPages = $arrayClientes["nr_paginas"];
            // $this->totalRecords = $arrayClientes["nr_registos"];
        }
        
    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaNomeCliente',$this->nomeCliente);


        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaNumeroCliente',$this->numeroCliente);

        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);

        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaZonaCliente',$this->zonaCliente);

        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaNifCliente',$this->nifCliente);

        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaTelemovelCliente',$this->telemovelCliente);

        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);

        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);

        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiPropostaEmailCliente',$this->emailCliente);

        Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiPropostaNr_paginas', $arrayClientes["nr_paginas"]);
        Session::put('AdiPropostaNr_registos', $arrayClientes["nr_registos"]);

        $this->clientes = session('AdiPropostaPaginator');
        $this->numberMaxPages = session('AdiPropostaNr_paginas');
        $this->totalRecords = session('AdiPropostaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        Session::put('AdiPropostaPageChosen', $this->pageChosen);


        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
            $this->clientes = session('AdiPropostaPaginator');
            
            // $this->clientes = $arrayClientes["paginator"];
        } else {
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                        
            Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
            $this->clientes = session('AdiPropostaPaginator');
            
            // $this->clientes = $arrayClientes["paginator"];
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            Session::put('AdiPropostaPageChosen', $this->pageChosen);

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                             
                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');
                
                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);

                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);

                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;
            Session::put('AdiPropostaPageChosen', $this->pageChosen);

            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                                
                Session::put('AdiPropostaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiPropostaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
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
        return view('livewire.propostas.propostas-adicionar',["clientes" => $this->clientes]);
    }
}
