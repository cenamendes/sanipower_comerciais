<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface PropostasInterface
{
    /** GET CATEGORIAS **/

    public function getCategorias(): object;

    public function getCategoriasSearched($idCategory,$idFamily): object;

    // public function getProdutosRandom(): object;

   

    /********* */

}