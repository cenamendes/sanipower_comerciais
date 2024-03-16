<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClientesInterface
{
    public function getListagemClientes($perPage,$page): LengthAwarePaginator;

    public function getNumberOfPages($perPage): int;

    public function getDetalhesCliente($id_cliente): object;

    public function getAnalisesCliente($id_cliente): object;

}