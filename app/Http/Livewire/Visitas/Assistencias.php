<?php

namespace App\Http\Livewire\Visitas;

use Dompdf\Dompdf;
use Livewire\Component;
use App\Models\Carrinho;
use App\Mail\SendProposta;
use App\Models\Comentarios;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Interfaces\VisitasInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class assistencias extends Component
{
    use WithPagination;

    private ?object $visitasRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";
    public string $idVisita = "";

    private ?object $propostasDetail = NULL;
    public ?string $propostaID = "";
    public ?string $propostaName = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    
    public ?string $nomeCliente = '';
    public ?string $numeroCliente = '';
    public ?string $zonaCliente = '';
    public ?string $telemovelCliente = '';
    public ?string $emailCliente = '';
    public ?string $nifCliente = '';

    public ?string $comentarioProposta = "";

    private ?object $detailsAssistencias = NULL;
    public ?object $comentario = NULL;

    public $estadoProposta = "";


    public function boot( VisitasInterface $visitasRepository)
    {
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
    }

    public function mount($idCliente)
    {
        $this->initProperties();
        $this->idCliente = $idCliente;
        
        $this->restartDetails();
    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $financeiroArray = $this->visitasRepository->getAssistencias($this->perPage,$this->pageChosen,$this->idCliente);
        $this->detailsAssistencias = $financeiroArray["object"];
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $financeiroArray = $this->visitasRepository->getAssistencias($this->perPage,$this->pageChosen,$this->idCliente);
            $this->detailsAssistencias = $financeiroArray["object"];
        }
        else if($this->pageChosen == 1){
            $financeiroArray = $this->visitasRepository->getAssistencias($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsAssistencias = $financeiroArray["object"];
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $financeiroArray = $this->visitasRepository->getAssistencias($this->perPage,$this->pageChosen,$this->idCliente);
            $this->detailsAssistencias = $financeiroArray["object"];
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
    public function restartDetails()
    {
        $financeiroArray = $this->visitasRepository->getAssistencias($this->perPage,$this->pageChosen,$this->idCliente);


        $this->numberMaxPages = $financeiroArray["nr_paginas"] + 1;
        $this->totalRecords = $financeiroArray["nr_registos"];
        $this->detailsAssistencias = $financeiroArray["object"];
    }

    public function updatedperPage(): void
    {
        $this->resetPage();
        session()->put('perPage', $this->perPage);


        $this->restartDetails();

    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function render()
    {
        return view('livewire.visitas.assistencias', ["detailsAssistencias" => $this->detailsAssistencias]);
    }
}
