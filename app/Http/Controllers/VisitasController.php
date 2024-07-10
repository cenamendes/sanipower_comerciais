<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ClientesInterface;
use App\Models\VisitasAgendadas;

class VisitasController extends Controller
{
    private ?object $clientesRepository = NULL;
    public function __construct(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    public function index()
    {
        return view('visitas.index',["idAgendar" => ""]);
    }

    public function agendarVisita($id)
    {
        return view('visitas.index', ["idAgendar" => $id]);
    }

    public function showDetail($id)
    {
        $detailsClientes = $this->clientesRepository->getDetalhesCliente($id);
        return view('visitas.details',["idVisita" => 0, "idCliente" => $id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "2"]); // adicionar
    }

    public function endVisita($id)
    {
        $visitaAgendada = VisitasAgendadas::where('id',$id)->first();

        $detailsClientes = $this->clientesRepository->getDetalhesCliente($visitaAgendada->client_id);
        return view('visitas.details',["idVisita" => $id, "idCliente" => $visitaAgendada->client_id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "1"]); //finalizar
    }

    public function clienteList()
    {
        return view('visitas.clientes', ["idAgendar" => ""]);
    }

    public function visitasInfo($id)
    {
        $visitaAgendada = VisitasAgendadas::where('client_id',$id)->first();
        
        $detailsClientes = $this->clientesRepository->getDetalhesCliente($visitaAgendada->client_id);
        return view('visitas.details',["idVisita" => $visitaAgendada->id, "idCliente" => $visitaAgendada->client_id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "1"]);
    }
}