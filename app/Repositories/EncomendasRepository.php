<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\ClientesInterface;
use App\Interfaces\EncomendasInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class EncomendasRepository implements EncomendasInterface
{
    public function getCategorias(): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/products/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);
    
        return $response_decoded; 

    }

    public function getSubFamily($idCategory, $idFamily, $idSubFamily): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/products/products?category_number='.$idCategory.'&family_number='.$idFamily.'&subfamily_number='.$idSubFamily.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);
    
        return $response_decoded; 
    }
    public function getProdutos($idCategory, $idFamily, $idSubFamily, $idCustomer): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/products/products?category_number='.$idCategory.'&family_number='.$idFamily.'&subfamily_number='.$idSubFamily.'&customer_number='.$idCustomer.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);
    
        return $response_decoded; 
    }
    
    
    public function getCategoriasSearched($idCategory,$idFamily): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/products/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);


        $arrayFiltrado = new stdClass;
        $arrayFiltrado->category = [];

    
        foreach($response_decoded->category as $i => $cat)
        {
            array_push($arrayFiltrado->category,$cat);
        }

        foreach($arrayFiltrado->category as $filter)
        {
            if($filter->id == $idCategory)
            {
                foreach($filter->family as $i => $family)
                {
                    if($family->id != $idFamily)
                    {
                        unset($filter->family[$i]);
                    }
                }
            }
        }

        return $arrayFiltrado; 

    }

    // public function getProdutosRandom(): object
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/products/GetProducts',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     $response_decoded = json_decode($response);

    //     dd($response_decoded);
    
    //     return $response_decoded; 

    // }


}