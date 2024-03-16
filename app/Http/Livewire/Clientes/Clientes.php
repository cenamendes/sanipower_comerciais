<?php

namespace App\Http\Livewire\Clientes;

use App\Models\User;
use Livewire\Component;
use App\Interfaces\ClientesInterface;
use App\Repositories\ClientesRepository;
use Livewire\WithPagination;


class Clientes extends Component
{
    use WithPagination;
    
    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;

    protected $listeners = ['dataTableAlterada' => 'dataTableAlterada'];

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

    public function mount()
    {
        $this->initProperties();
        $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
        $this->numberMaxPages = $this->clientesRepository->getNumberOfPages($this->perPage);
    }

    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$page);
    }

   
    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage, $this->pageChosen);
        }
        else if($this->pageChosen == 1){
            $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage, $this->pageChosen);
        }
    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;
            $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage, $this->pageChosen);
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

        $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);

        $this->numberMaxPages = $this->clientesRepository->getNumberOfPages($this->perPage);
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

        
    public function render()
    {
        return view('livewire.clientes.clientes',["clientes" => $this->clientes]);
    }
}
