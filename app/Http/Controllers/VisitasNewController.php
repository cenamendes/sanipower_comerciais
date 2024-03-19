<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitasNewController extends Controller
{
    public function index()
    {
        return view('visitas.visita');
    }

    public function showDetail($id)
    {
        return view('visitas.visita',["idCliente" => $id]);
    }
}