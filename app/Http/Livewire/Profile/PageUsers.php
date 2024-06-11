<?php
namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class PageUsers extends Component
{
    use WithPagination;

    public $filterNome;
    public $filterEmail;
    public $filterTelemovel;
    public $totalRecords;
    public $pageChosen;
    public $perPage;
    public $numberMaxPages;
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
    public function getPageRange()
    {
        $currentPage = $this->pageChosen;
        $lastPage = $this->numberMaxPages;

        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);

        return range($start, $end);
    }
    public function mount()
    {
        $this->initProperties();
        
    }
    public function updatingFilterNome()
    {
        $this->resetPage();
    }
    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function updatingFilterEmail()
    {
        $this->resetPage();
    }

    public function updatingFilterTelemovel()
    {
        $this->resetPage();
    }

    // public function gotoPage($page)
    // {
    //     $this->pageChosen = $page;

    //     if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
    //         $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
    //     } else {
    //         $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
    //     }
        
    // }

   
    // public function previousPage()
    // {
    //     if ($this->pageChosen > 1) {
    //         $this->pageChosen--;

    //         if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
    //             $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
    //         } else {
    //             $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
    //         }
    //     }
    //     else if($this->pageChosen == 1){
    //         if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
    //             $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
    //         } else {
    //             $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
    //         }
    //     }
    // }

    // public function nextPage()
    // {
    //     if ($this->pageChosen < $this->numberMaxPages) {
    //         $this->pageChosen++;

    //         if($this->nomeCliente != "" || $this->numeroCliente != ""  || $this->zonaCliente != ""){
    //             $this->clientes = $this->clientesRepository->getListagemClienteFiltro($this->perPage,$this->pageChosen,$this->nomeCliente,$this->numeroCliente,$this->zonaCliente);
    //         } else {
    //             $this->clientes = $this->clientesRepository->getListagemClientes($this->perPage,$this->pageChosen);
    //         }
    //     }
    // }


    public function isCurrentPage($page)
    {
        return $page == $this->pageChosen;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->filterNome, function($query) {
                $query->where('name', 'like', '%' . $this->filterNome . '%');
            })
            ->when($this->filterEmail, function($query) {
                $query->where('email', 'like', '%' . $this->filterEmail . '%');
            })
            ->when($this->filterTelemovel, function($query) {
                $query->where('telefone', 'like', '%' . $this->filterTelemovel . '%');
            })
            ->paginate($this->perPage);

            $this->totalRecords = $users->total();
            $this->pageChosen = $users->currentPage();
            $this->numberMaxPages = $users->lastPage();

        return view('livewire.profile.page-users', [
            'users' => $users,
        ]);
    }
}
