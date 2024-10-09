<?php

namespace App\Http\Livewire\Visitas;

use Dompdf\Dompdf;

use Livewire\Component;
use App\Models\Carrinho;
use App\Mail\SendProposta;
use App\Models\Comentarios;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\VisitasInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Financeiro extends Component
{
    use WithPagination,WithFileUploads;
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

    public string $assunto = "";
    public string $relatorio = "";
    public string $pendentes = "";
    public string $comentario_encomendas = "";
    public string $comentario_propostas = "";
    public string $comentario_financeiro = "";
    public string $comentario_occorencias = "";
    public int $tipoVisitaSelect;

    public ?string $comentarioProposta = "";

    private ?object $detailsfinanceiro = NULL;
    public ?object $comentario = NULL;

    public $estadoProposta = "";


    public $anexos = [];
    public $tempPaths = [];
    protected $listeners = ['atualizarFinanceiro' => 'render'];

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
        // Session::forget('visitasPropostasAnexos');
        $this->initProperties();
        $this->idCliente = $idCliente;
        
        if(session('visitasPropostasComentario_financeiro')){
            $this->comentario_financeiro = session('visitasPropostasComentario_financeiro');
        }
        if(session('visitasPropostasCheckStatus')){
            $this->checkStatus = session('visitasPropostasCheckStatus');
        }

        $this->restartDetails();
    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $this->detailsfinanceiro = $financeiroArray["object"];
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);
            $this->detailsfinanceiro = $financeiroArray["object"];
        }
        else if($this->pageChosen == 1){
            $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsfinanceiro = $financeiroArray["object"];
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);

            $this->detailsfinanceiro = $financeiroArray["object"];
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
        $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);

        $this->numberMaxPages = $financeiroArray["nr_paginas"] + 1;
        $this->totalRecords = $financeiroArray["nr_registos"];
        $this->detailsfinanceiro = $financeiroArray["object"];
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
    public function updatedComentarioFinanceiro()
    {
        Session::put('visitasPropostasComentario_financeiro', $this->comentario_financeiro );
    }
    public function removeAnexo($filePath)
    {
        $currentAnexos = Session::get('visitasPropostasAnexos', []);
    
        // dd($currentAnexos ,$filePath);
        $currentAnexos = array_filter($currentAnexos, function($file) use ($filePath) {
            return $file !== $filePath;
        });
        Session::put('visitasPropostasAnexos', $currentAnexos);
    
        if (\Storage::disk('public')->exists($filePath)) {
            \Storage::disk('public')->delete($filePath);
        }
        $this->anexos=  $currentAnexos;
        $this->tempPaths = $currentAnexos;
   
        Session::put('visitasPropostasAnexos', $currentAnexos);

    }
    
    

    public function updatedAnexos()
    {
        // Recupera o valor atual da sessão ou um array vazio caso não exista
        $currentAnexos = Session::get('visitasPropostasAnexos', []);

        foreach ($this->anexos as $anexo) {
            // Recupera o nome original do arquivo
            $originalName = $anexo->getClientOriginalName();
    
            // Armazena o arquivo em 'temp' usando o nome original com um timestamp para evitar conflitos
            $path = $anexo->storeAs('temp', time() . '_' . $originalName, 'public');
    
            // Adiciona o novo arquivo ao array temporário
            $currentAnexos[] = [
                'path' => $path,
                'original_name' => $originalName,
            ];
        }
    
        // Atualiza a sessão com os anexos combinados (antigos e novos)
        Session::put('visitasPropostasAnexos', $currentAnexos);
    
        // Atualiza a propriedade local também, caso precise refletir isso no estado do componente
        $this->tempPaths = $currentAnexos;
    }

    public function render()
    {
        $financeiroArray = $this->visitasRepository->getFinanceiroCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $this->detailsfinanceiro = $financeiroArray["object"];

        if(session('visitasPropostasComentario_financeiro')){
            $this->comentario_financeiro = session('visitasPropostasComentario_financeiro');
        }
        if(session('visitasPropostasAnexos')){
            $this->anexos = session('visitasPropostasAnexos');
        }

        return view('livewire.visitas.financeiro', ["detailsfinanceiro" => $this->detailsfinanceiro]);
    }
}
