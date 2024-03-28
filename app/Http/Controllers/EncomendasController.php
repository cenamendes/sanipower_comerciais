<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncomendasController extends Controller
{
    public function index()
    {
        return view('encomendas.index');
    }

    public function showDetail($id)
    {
        return view('encomendas.details',["idCliente" => $id]);
    }
}
