<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ClientesInterface;

class VisitasController extends Controller
{
    private ?object $clientesRepository = NULL;
    public function __construct(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    public function index()
    {
        return view('visitas.index');
    }

    public function showDetail($id)
    {
        
        $detailsClientes = $this->clientesRepository->getDetalhesCliente($id);
        return view('visitas.details',["idCliente" => $id, "nameCliente" => $detailsClientes->customers[0]->name]);
    }
}