<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\VisitasAgendadas;
use App\Models\TiposVisitas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Detalheagendadas extends Component
{
    public $visitas = [];
    public $tiposvisitas = [];

    protected $listeners = ['reloadNotification' => 'notificationArrived'];
    
    public function mount()
    {
        $currentDate = Carbon::today()->toDateString();
        $userId = Auth::id();

        if(Auth::user()->nivel == "3")
        {
            $this->visitas = VisitasAgendadas::with('tipovisita')
                ->where('data_inicial', '>=', $currentDate)
                ->where('finalizado','!=', 1)
                ->orderBy('data_inicial', 'asc')
                ->get();
        }
        else {
            $this->visitas = VisitasAgendadas::with('tipovisita')
            ->where('user_id', $userId)
            ->where('data_inicial', '>=', $currentDate)
            ->where('finalizado','!=', 1)
            ->orderBy('data_inicial', 'asc')
            ->get();
        }

        $this->tiposvisitas = TiposVisitas::all();
    }

    public function notificationArrived()
    {
        $currentDate = Carbon::today()->toDateString();
        $userId = Auth::id();

        if(Auth::user()->nivel == "3")
        {
            $this->visitas = VisitasAgendadas::with('tipovisita')
                ->where('data_inicial', '>=', $currentDate)
                ->where('finalizado','!=', 1)
                ->orderBy('data_inicial', 'asc')
                ->get();
        }
        else {
            $this->visitas = VisitasAgendadas::with('tipovisita')
            ->where('user_id', $userId)
            ->where('finalizado','!=', 1)
            ->where('data_inicial', '>=', $currentDate)
            ->orderBy('data_inicial', 'asc')
            ->get();
        }

            
        $this->tiposvisitas = TiposVisitas::all();
    }

    public function render()
    {
        return view('livewire.visitasagendadas.visitas-agendadas');
    }
}
