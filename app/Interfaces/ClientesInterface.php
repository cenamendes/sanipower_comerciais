<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClientesInterface
{
    public function getListagemClientes($perPage,$page): LengthAwarePaginator;

    public function getNumberOfPages($perPage): array;


    /** FILTRO POR CLIENTE */

    public function getListagemClienteFiltro($perPage,$page,$nomeCliente,$numeroCliente,$zonaCliente): LengthAwarePaginator;

    public function getNumberOfPagesClienteFiltro($perPage,$nomeCliente,$numeroCliente,$zonaCliente): array;

    /*********** */

    //** DETLAHES CLIENTE */

    public function getDetalhesCliente($id_cliente): object;

    public function getListagemAnalisesCliente($perPage,$page,$idCliente):LengthAwarePaginator;

    public function getNumberOfPagesAnalisesCliente($perPage,$idCliente): array;



    public function getEncomendasCliente($perPage,$page,$nomeCliente): LengthAwarePaginator;

    public function getNumberOfPagesEncomendasCliente($perPage,$idCliente): array;

    public function getPropostasCliente($perPage,$page,$nomeCliente): LengthAwarePaginator;

    public function getNumberOfPagesPropostasCliente($perPage,$idCliente): array;

   

    /****** */

}