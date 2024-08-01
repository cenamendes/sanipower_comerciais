<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitasAgendadas;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;

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
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($id);
        $detailsClientes = $arrayCliente["object"];
        return view('visitas.details',["idVisita" => 0, "idCliente" => $id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "2"]); // adicionar
    }

    public function endVisita($id)
    {
        $visitaAgendada = VisitasAgendadas::where('id',$id)->first();

        $arrayCliente = $this->clientesRepository->getDetalhesCliente($visitaAgendada->client_id);
        $detailsClientes = $arrayCliente["object"];
        return view('visitas.details',["idVisita" => $id, "idCliente" => $visitaAgendada->client_id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "1"]); //finalizar
    }

    public function clienteList()
    {
        return view('visitas.clientes', ["idAgendar" => ""]);
    }

    public function visitasInfo($id)
    {
        $visitaAgendada = VisitasAgendadas::where('id',$id)->first();

        
        Session::put('rota','visitas');
          
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($visitaAgendada->client_id);
        $detailsClientes = $arrayCliente["object"];
        
        return view('visitas.details',["idVisita" => $id, "idCliente" => $visitaAgendada->client_id, "nameCliente" => $detailsClientes->customers[0]->name, "tst" => "1"]);
    }
}