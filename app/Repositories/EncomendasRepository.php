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

    public function getCategoriasSearched($idFamily): object
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

        // $filtrado = new StdClass;
        $filtrado = [];

    
        foreach($response_decoded->category as $i => $cat)
        {
            foreach($cat->family as $fam)
            {
                if($fam->id == $idFamily)
                {
                    array_push($filtrado,$fam); 
                }
            }

            // AQUI VERIFICO SE FOR DIFERENTE DA CATEGORIA QUE VEM DE PARAMETRO GUARDO TAMBEM PARA O ARRAY
            //ASSIM VEM AS OUTRAS
            
        }



        $name = "";

        // foreach($response_decoded->category as $nam)
        // {
        //     if($nam->id == $idCategory)
        //     {
        //         $name = $nam->name;
        //     }
        // }
       
        $arr = new stdClass;
        $arr->category = new stdClass;
        $arr->category->category = new stdClass;
        $arr->category->category->id = "1";
        $arr->category->category->name = "Sistemas";
        $arr->category->category->family = $filtrado; 
    
        return $arr; 

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