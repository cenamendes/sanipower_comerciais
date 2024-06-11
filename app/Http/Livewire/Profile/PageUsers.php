<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class PageUsers extends Component
{
    use WithPagination;
    protected $listeners = ['refreshTable' => '$refresh'];
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
        $this->emit('filtersUpdated');
    }

    public function updatingFilterEmail()
    {
        $this->resetPage();
        $this->emit('filtersUpdated');
    }

    public function updatingFilterTelemovel()
    {
        $this->resetPage();
        $this->emit('filtersUpdated');
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

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
