<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface EncomendasInterface
{
    /** GET CATEGORIAS **/

    public function getCategorias(): object;

    // public function getProdutosRandom(): object;

    /********* */

}