<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampanhasController extends Controller
{
    public function index(){
        return view("Campanhas.index");
    }
}
