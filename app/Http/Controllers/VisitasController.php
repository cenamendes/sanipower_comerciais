<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitasController extends Controller
{
    public function index()
    {
        return view('visitas.index');
    }

    public function showDetail($id)
    {
        return view('visitas.details',["idCliente" => $id]);
    }
}