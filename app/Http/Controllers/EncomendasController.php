<?php

namespace App\Http\Controllers;

use App\Interfaces\ClientesInterface;
use Illuminate\Http\Request;

class EncomendasController extends Controller
{
    
    private ?object $clientesRepository = NULL;
    public function __construct(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    public function index()
    {
        return view('encomendas.index');
    }

    public function showDetail($id)
    {
        $detailsClientes = $this->clientesRepository->getDetalhesCliente($id);
        return view('encomendas.details',["idCliente" => $id,"nameCliente" => $detailsClientes->customers[0]->name]);
    }
}
