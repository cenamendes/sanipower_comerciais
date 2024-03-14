<?php

namespace App\Repositories;

use stdClass;
use App\Models\User;
use App\Interfaces\ClientesInterface;

class ClientesRepository implements ClientesInterface
{
    public function getListagemClientes(): object
    {
        //APANHA LISTAGEM
        $user = User::all();
        return $user;
    }

    public function getDetalhesCliente($id): object
    {
        //APANHA DETALHES
        $user = User::all();
        return $user;
    }

    public function getAnalisesCliente($id): object
    {
        //APANHA ANALISES
        $user = User::all();
        return $user;
    }

}