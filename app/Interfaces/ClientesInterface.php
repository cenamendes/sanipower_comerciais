<?php

namespace App\Interfaces;

interface ClientesInterface
{
    public function getListagemClientes(): object;

    public function getDetalhesCliente($id_cliente): object;

    public function getAnalisesCliente($id_cliente): object;

}