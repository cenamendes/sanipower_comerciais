<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;

class DetalheVisitas extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    public int $perPage = 10;
    public int $perPageRelatorio = 10;

    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    private ?object $detailsClientes = NULL;
    private ?object $analysisClientes = NULL;

    public string $tabDetail = "show active";
    public string $tabAnalysis = "";
    public string $tabRelatorio = "";
    public string $tabEncomendas = "";
    public string $tabPropostas = "";
    public string $tabFinanceiro = "";
    public string $tabOcorrencia = "";
    public string $tabVisitas = "";
    public string $tabAssistencias = "";


    //FORM
    public string $assunto = "";
    public string $relatorio = "";
    public string $pendentes = "";
    public string $comentario_encomendas = "";
    public string $comentario_propostas = "";
    public string $comentario_financeiro = "";
    public string $comentario_occorencias = "";

    private ?object $encomendasDetail = NULL;

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

        $this->restartDetails();

    }

    
    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
    
        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
    }

   
    public function previousPage()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        
       
        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
    }

    public function nextPage()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        
        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
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


        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";

        $this->restartDetails();

    }
    public function updatedPerPageRelatorio(): void
    {
        $this->resetPage();
        session()->put('perPageRelatorio', $this->perPageRelatorio);


        $this->tabRelatorio = "show active";
        $this->tabDetail = "";
        $this->tabAnalysis = "";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";


        $this->restartDetails();

    }

    public function restartDetails()
    {
        $this->detailsClientes = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesAnalisesCliente($this->perPageRelatorio,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];
    }

    public function saveVisita()
    {
        $this->restartDetails();

        $response = $this->clientesRepository->storeVisita($this->detailsClientes->customers[0]->no,$this->assunto,$this->relatorio,$this->pendentes,$this->comentario_encomendas,$this->comentario_propostas,$this->comentario_financeiro,$this->comentario_occorencias);

        $responseArray = $response->getData(true);
        
        if($responseArray["success"] == true){
            session()->flash('success', "Visita criada com sucesso");
         } else {
             session()->flash('error', "Não foi possivel adicionar a visita");
         }

        $this->skipRender();


        return redirect()->route('visitas');

    }
    
    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function render()
    {
        return view('livewire.visitas.detalhe-visitas',["detalhesCliente" => $this->detailsClientes, "analisesCliente" =>$this->analysisClientes]);
    }
}
