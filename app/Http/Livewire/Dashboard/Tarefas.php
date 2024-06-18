<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\TiposVisitas;
use App\Interfaces\TarefasInterface;
use App\Interfaces\VisitasInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarefas as TarefasModels;

class Tarefas extends Component
{
    private ?object $visitasRepository = null;
    private ?object $tarefasRepository = null;

    public ?array $listagemTarefas = null;

    public ?string $idTarefaTemp = null;
    public ?string $clienteTemp = null;
    public ?string $assuntoTemp = null;
    public ?string $descricaoTemp = null;

    public ?string $clienteNameTarefa = "";
    public ?string $dataInicialTarefa = "";
    public ?string $horaInicialTarefa = "";
    public ?string $horaFinalTarefa = "";
    public ?string $assuntoTarefa = "";
    public ?string $descricaoTarefa = "";

    public $iteration;

    public ?object $tipoVisita = NULL;
    public ?string $clienteVisita = "";
    public ?string $dataInicialVisita = "";
    public ?string $horaInicialVisita = "";
    public ?string $horaFinalVisita = "";
    public ?string $tipoVisitaEscolhidoVisita = "";
    public ?string $assuntoTextVisita = "";

    protected $listeners = ["changeStatusTarefa" => "changeStatusTarefa", "getTarefaInfo" => "getTarefaInfo"];

    public function boot(VisitasInterface $visitasRepository, TarefasInterface $tarefaRepository)
    {
        $this->visitasRepository = $visitasRepository;
        $this->tarefasRepository = $tarefaRepository;
    }

    public function mount()
    {
        $this->listagemTarefas = $this->visitasRepository->getListagemVisitasAndTarefas(Auth::user()->id);
    }

    public function changeStatusTarefa($idTarefa,$status)
    {
        $change = $this->tarefasRepository->changeStatusTarefa($idTarefa,$status);

        $responseArray = $change->getData(true);

        if ($responseArray["success"] == true) {
           
            $message = "Estado da tarefa alterado com sucesso!";
          
            $status = "success";
        } else {
            $message = "Não foi possivel alterar a tarefa!";
            $status = "error";
        }
     
        $this->dispatchBrowserEvent('sendToaster', ["message" => $message, "status" => $status]);
    }

    public function getTarefaInfo($idTarefa)
    {
        $tarefa = TarefasModels::where('id',$idTarefa)->first();

        $this->clienteTemp = $tarefa->cliente;
        $this->assuntoTemp = $tarefa->assunto_text;
        $this->descricaoTemp = $tarefa->descricao;
        $this->idTarefaTemp = $tarefa->id;

        $this->dispatchBrowserEvent('openModalTarefa');
    }

    public function changeTarefa($tarefaID)
    {
        if($this->clienteTemp == "" || $this->assuntoTemp == "" || $this->descricaoTemp == "")
        {
            $message = "Tem de preencher todos os campos!";
            $status = "error";

            $this->dispatchBrowserEvent('sendToaster', ["message" => $message, "status" => $status]);

            return false;
        }

        $changeTarefa = $this->tarefasRepository->changeTarefaInformation($tarefaID,$this->clienteTemp, $this->assuntoTemp, $this->descricaoTemp);

        $responseArray = $changeTarefa->getData(true);

        if ($responseArray["success"] == true) {
           
            $message = "Tarefa alterada com sucesso!";
          
            $status = "success";
        } else {
            $message = "Não foi possivel alterar a tarefa!";
            $status = "error";
        }

        $this->listagemTarefas = $this->visitasRepository->getListagemVisitasAndTarefas(Auth::user()->id);
     
        $this->dispatchBrowserEvent('updateList', ["message" => $message, "status" => $status]);

    }

    public function addTarefaButton()
    {
        $this->dispatchBrowserEvent('openModalAddTarefa');
    }


    public function saveTarefa()
    {
        if($this->dataInicialTarefa == "" ||$this->horaInicialTarefa == "" || $this->horaFinalTarefa == "" || $this->assuntoTarefa == "" || $this->descricaoTarefa == "" )
        {
            $this->dispatchBrowserEvent('sendToaster', ["message" => "Tem de preencher todos os campos", "status" => "error"]);
            return false;
        }

        if(strtotime($this->horaInicialTarefa) > strtotime($this->horaFinalTarefa))
        {
            $this->dispatchBrowserEvent('sendToaster', ["message" => "Hora final tem de ser superior á hora inicial", "status" => "error"]);
            return false;
        }

        $addTarefa = $this->tarefasRepository->addNewTarefa($this->clienteNameTarefa,$this->dataInicialTarefa, $this->horaInicialTarefa, $this->horaFinalTarefa, $this->assuntoTarefa, $this->descricaoTarefa);

        $responseArray = $addTarefa->getData(true);

        if ($responseArray["success"] == true) {
           
            $message = "Tarefa adicionada com sucesso!";
          
            $status = "success";
        } else {
            $message = "Não foi possivel alterar a tarefa!";
            $status = "error";
        }

        $this->listagemTarefas = $this->visitasRepository->getListagemVisitasAndTarefas(Auth::user()->id);
     
        $this->dispatchBrowserEvent('sendToaster', ["message" => $message, "status" => $status]);
        $this->dispatchBrowserEvent('updateList', ["message" => $message, "status" => $status]);

        //continuar o insert
    }

    public function addVisita()
    {
        $this->tipoVisita = TiposVisitas::all();
        $this->dispatchBrowserEvent('openVisitaModal');
    }

    public function agendaVisita()
    {

        if($this->clienteVisita == "" || $this->dataInicialVisita == "" ||$this->horaInicialVisita == "" || $this->horaFinalVisita == "" || $this->tipoVisitaEscolhidoVisita == "" || $this->assuntoTextVisita == "" )
        {
            $this->dispatchBrowserEvent('sendToaster', ["message" => "Tem de preencher todos os campos", "status" => "error"]);
            return false;
        }

        if(strtotime($this->horaInicialVisita) > strtotime($this->horaFinalVisita))
        {
            $this->dispatchBrowserEvent('sendToaster', ["message" => "Hora final tem de ser superior á hora inicial", "status" => "error"]);
            return false;
        }

        $response = $this->visitasRepository->addVisitaDatabase($this->clienteVisita,$this->clienteVisita, preg_replace('/[a-zA-Z]/', '', $this->dataInicialVisita), preg_replace('/[a-zA-Z]/', '', $this->horaInicialVisita), preg_replace('/[a-zA-Z]/', '', $this->horaFinalVisita), $this->tipoVisitaEscolhidoVisita, $this->assuntoTextVisita);

        $responseArray = $response->getData(true);

        if ($responseArray["success"] == true) {
            $message = "Visita agendada com sucesso";
            $status = "success";
        } else {
            $message = "Não foi possivel adicionar a visita!";
            $status = "error";
        }

        $this->listagemTarefas = $this->visitasRepository->getListagemVisitasAndTarefas(Auth::user()->id);

        $this->emit('reloadNotification');
        $this->emit('visitaAdded');

        $this->dispatchBrowserEvent('updateList');
        $this->dispatchBrowserEvent('sendToaster', ["message" => $message, "status" => $status]);
    }

    public function render()
    {
        return view('livewire.dashboard.tarefas');
    }
}
