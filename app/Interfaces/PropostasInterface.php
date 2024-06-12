<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface PropostasInterface
{
    /** GET CATEGORIAS **/

    public function getCategorias(): object;


    public function getCategoriasSearched($idCategory,$idFamily): object;

    public function getSubFamily($idCategory, $idFamily, $idSubFamily): object;

    public function getSubFamilySearch($idCategory, $idFamily, $idSubFamily,$searchProduct): object;

    public function getProdutos($idCategory, $idFamily, $idSubFamily, $productNumber, $idCustomer): object;

    
    /*** PARTE DO CARRINHO ***/

    public function addProductToDatabase($idCliente,$qtd,$nameProduct,$no,$ref,$codType,$type): JsonResponse;
 
    /********** */

   

    /********* */

}