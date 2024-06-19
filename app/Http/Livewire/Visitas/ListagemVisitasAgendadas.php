<?php

namespace App\Http\Livewire\Visitas;

use App\Models\User;
use Livewire\Component;
use App\Models\TiposVisitas;
use Livewire\WithPagination;
use App\Models\VisitasAgendadas;
use App\Interfaces\VisitasInterface;
use App\Interfaces\ClientesInterface;


class ListagemVisitasAgendadas extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;
    private ?object $clientesRepository = NULL;
    private ?object $visitasRepository = NULL;
    public ?string $activeFinalizado = "";


    protected $listagemVisitas;
    public ?string $clientID = "";


    public function boot(ClientesInterface $clientesRepository, VisitasInterface $visitasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->visitasRepository = $visitasRepository;
    }

    public function mount($clientID, $activeFinalizado)
    {
        $this->clientID = $clientID;
        $this->activeFinalizado = $activeFinalizado;
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

    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function endVisita($visitaId)
    {

        if($this->activeFinalizado == "2"){
            
            return redirect()->route('visitas.end-visita',["id" => $visitaId]);
        }else if($this->activeFinalizado == "1"){

            $this->emit('eventoChamarSaveVisita',["visitaId" => $visitaId]);

            //é so alterar no visitas agendadas
            //criar no visitas o novo registo
               //ver se tem os valores dos relatorios
            
        }
    }


    public function render()
    {
        if($this->clientID != "")
        {
            $this->listagemVisitas = $this->visitasRepository->getVisitasAgendadas($this->clientID);
            $this->totalRecords = $this->listagemVisitas->total();
            $this->pageChosen = $this->listagemVisitas->currentPage();
            $this->numberMaxPages = $this->listagemVisitas->lastPage();
        }
        
        return view('livewire.visitas.listagem-visitas-agendadas',["listagemVisitas" => $this->listagemVisitas]);
    }
}
