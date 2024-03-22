<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface VisitasInterface
{
    public function getListagemVisitas($perPage,$page): LengthAwarePaginator;

    public function getNumberOfPages($perPage): array;


    /** FILTRO POR Visitas */

    public function getListagemVisitasFiltro($perPage,$page,$nomeVisitas,$numeroVisitas,$zonaVisitas): LengthAwarePaginator;

    public function getNumberOfPagesVisitasFiltro($perPage,$nomeVisitas,$numeroVisitas,$zonaVisitas): array;

    /*********** */

    //** DETLAHES Visitas */

    public function getDetalhesVisitas($id_Visitas): object;

    public function getListagemAnalisesVisitas($perPage,$page,$idVisitas): LengthAwarePaginator;

    public function getNumberOfPagesAnalisesVisitas($perPage,$idVisitas): array;

    /****** */

}