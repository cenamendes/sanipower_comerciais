<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function index()
    {
        return view('clientes.index');
    }

    public function showDetail($id)
    {
       
        return view('clientes.details',["idCliente" => $id]);
    }
}
