<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface EncomendasInterface
{
    /** GET CATEGORIAS **/

    public function getCategorias(): object;


    public function getCategoriasSearched($idCategory,$idFamily): object;

    public function getSubFamily($idCategory, $idFamily, $idSubFamily): object;

    public function getSubFamilySearch($idCategory, $idFamily, $idSubFamily,$searchProduct): object;

    public function getProdutos($idCategory, $idFamily, $idSubFamily, $productNumber, $idCustomer): object;

    // public function getProdutosRandom(): object;

   

    /********* */

}