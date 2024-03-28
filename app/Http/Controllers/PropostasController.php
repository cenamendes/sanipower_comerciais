<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropostasController extends Controller
{
    public function index()
    {
        return view('propostas.index');
    }

    public function showDetail($id)
    {
        return view('propostas.details',["idCliente" => $id]);
    }
}
