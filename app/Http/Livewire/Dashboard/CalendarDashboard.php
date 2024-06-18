<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Interfaces\VisitasInterface;
use Illuminate\Support\Facades\Auth;

class CalendarDashboard extends Component
{
    private ?object $visitasRepository = null;

    public ?object $listagemCalendario = null;

    protected $listeners = ['visitaAdded' => 'visitaArrived'];

    public function boot(VisitasInterface $visitasRepository)
    {
        $this->visitasRepository = $visitasRepository;
    }

    public function mount()
    {
        $this->listagemCalendario = $this->visitasRepository->getListagemVisitasAgendadas(Auth::user()->id);
    }

    public function visitaArrived()
    {
        $this->listagemCalendario = $this->visitasRepository->getListagemVisitasAgendadas(Auth::user()->id);

        $this->dispatchBrowserEvent('restartCalendar');
    }

    public function render()
    {
        return view('livewire.dashboard.calendar-dashboard');
    }
}
