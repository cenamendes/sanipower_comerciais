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

    protected $listagemVisitas;
    public ?string $clientID = "";


    public function boot(ClientesInterface $clientesRepository, VisitasInterface $visitasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->visitasRepository = $visitasRepository;
    }

    public function mount($clientID)
    {
        $this->clientID = $clientID;
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
        $this->emit('eventoChamarSaveVisita');
        return redirect()->route('visitas.end-visita',["id" => $visitaId]);
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
