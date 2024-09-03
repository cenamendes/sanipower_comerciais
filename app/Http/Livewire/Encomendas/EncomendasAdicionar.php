<?php

namespace App\Http\Livewire\Encomendas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;
use App\Interfaces\EncomendasInterface;

class EncomendasAdicionar extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    private ?object $encomendasRepository = NULL;

    protected ?object $clientes = NULL;

    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';
    

    public function boot(ClientesInterface $clientesRepository, EncomendasInterface $encomendasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->encomendasRepository = $encomendasRepository;

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

        $this->nomeCliente = session('AdiEncomendaNomeCliente');
        $this->numeroCliente = session('AdiEncomendaNumeroCliente');
        $this->zonaCliente = session('AdiEncomendaZonaCliente');
        $this->telemovelCliente = session('AdiEncomendaTelemovelCliente');
        $this->emailCliente = session('AdiEncomendaEmailCliente');
        $this->nifCliente = session('AdiEncomendaNifCliente');
    }

    public function mount()
    {
        $this->initProperties();

        // $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
        // $this->clientes = $arrayClientes["paginator"];
     

        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];


        if(session('AdiEncomendaPaginator')){
            $this->clientes = session('AdiEncomendaPaginator');

            if(session('AdiEncomendaNr_paginas') == 0 || session('AdiEncomendaNr_paginas')){

                $this->numberMaxPages = session('AdiEncomendaNr_paginas');
            }
            if(session('AdiEncomendaNr_registos')){
                $this->totalRecords = session('AdiEncomendaNr_registos');
            }
            if(session('AdiEncomendaPageChosen')){
                $this->pageChosen = session('AdiEncomendaPageChosen');
            }
        }else{
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);

            Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
            Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
            Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);
    
            $this->clientes = session('AdiEncomendaPaginator');
            $this->numberMaxPages = session('AdiEncomendaNr_paginas');
            $this->totalRecords = session('AdiEncomendaNr_registos');

            // $this->clientes = $arrayClientes["paginator"];
            // $this->numberMaxPages = $arrayClientes["nr_paginas"];
            // $this->totalRecords = $arrayClientes["nr_registos"];
        }
    }


    public function rotaDetailEncomendas($id){

        $getCategories = $this->encomendasRepository->getCategorias();

        $firstCategories = $getCategories->category[0];
        session(['searchNameCategory' => $firstCategories->name]);

        $firstFamily = $firstCategories->family[0];
        session(['searchNameFamily' => $firstFamily->name]);

        $firstSubFamily = $firstFamily->subfamily[0];
        session(['searchNameSubFamily' => $firstSubFamily->name]);

        $searchSubFamily = $this->encomendasRepository->getSubFamily($firstCategories->id, $firstFamily->id, $firstSubFamily->id);

        session(['searchSubFamily' => $searchSubFamily]);
        session()->forget('searchSubFamily');

        session(['rota' => "encomendas.nova"]);
        session(['parametro' => ""]);

        $this->clientes = session('AdiEncomendaPaginator');
        return redirect()->route('encomendas.detail', ['id' => $id]);

    }

    public function updatedNomeCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaNomeCliente',$this->nomeCliente);

        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);

        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNumeroCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaNumeroCliente',$this->numeroCliente);


        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');


        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedZonaCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaZonaCliente',$this->zonaCliente);

        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedNifCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaNifCliente',$this->nifCliente);

        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedTelemovelCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaTelemovelCliente',$this->telemovelCliente);

        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function updatedEmailCliente()
    {
        $this->pageChosen = 1;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
        Session::put('AdiEncomendaEmailCliente',$this->emailCliente);

        Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
        Session::put('AdiEncomendaNr_paginas', $arrayClientes["nr_paginas"] + 1);
        Session::put('AdiEncomendaNr_registos', $arrayClientes["nr_registos"]);


        $this->clientes = session('AdiEncomendaPaginator');
        $this->numberMaxPages = session('AdiEncomendaNr_paginas');
        $this->totalRecords = session('AdiEncomendaNr_registos');

        // $this->clientes = $arrayClientes["paginator"];
        // $this->numberMaxPages = $arrayClientes["nr_paginas"];
        // $this->totalRecords = $arrayClientes["nr_registos"];
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        Session::put('AdiEncomendaPageChosen', $this->pageChosen);
        if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
            $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
            
            Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
            $this->clientes = session('AdiEncomendaPaginator');
            
            // $this->clientes = $arrayClientes["paginator"];
        } else {
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            
            Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
            $this->clientes = session('AdiEncomendaPaginator');

            // $this->clientes = $arrayClientes["paginator"];
        }
        
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            Session::put('AdiEncomendaPageChosen', $this->pageChosen);
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');

                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');
                
                // $this->clientes = $arrayClientes["paginator"];
            }
        }
        else if($this->pageChosen == 1){
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');
                
                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');
                
                // $this->clientes = $arrayClientes["paginator"];
            }
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;
            Session::put('AdiEncomendaPageChosen', $this->pageChosen);
            if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != "" || $this->telemovelCliente != "" || $this->emailCliente != "" || $this->nifCliente != ""){
                $arrayClientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente,$this->telemovelCliente,$this->emailCliente,$this->nifCliente);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');
                
                // $this->clientes = $arrayClientes["paginator"];
            } else {
                $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
                
                Session::put('AdiEncomendaPaginator', $arrayClientes["paginator"]);
                $this->clientes = session('AdiEncomendaPaginator');

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

            $this->numberMaxPages = $arrayClientes["nr_paginas"] + 1;
            $this->totalRecords = $arrayClientes["nr_registos"];
        } else {
            $arrayClientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
            $this->clientes = $arrayClientes["paginator"];
        

            $this->numberMaxPages = $arrayClientes["nr_paginas"] + 1;
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
