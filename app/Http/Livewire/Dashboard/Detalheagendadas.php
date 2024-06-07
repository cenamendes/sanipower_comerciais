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

    public function mount()
    {
        $currentDate = Carbon::today()->toDateString();
        $userId = Auth::id();


        $this->visitas = VisitasAgendadas::with('tipovisita')
            ->where('user_id', $userId)
            ->where('data_inicial', '>=', $currentDate)
            ->orderBy('data_inicial', 'asc')
            ->get();

        $this->tiposvisitas = TiposVisitas::all();
    }

    public function render()
    {
        return view('livewire.visitasagendadas.visitas-agendadas');
    }
}
