<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\ClientesInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientesRepository implements ClientesInterface
{
    public function getListagemClientes($perPage,$page): LengthAwarePaginator
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page='.$page,
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($response_decoded != null)
        {
            $currentItems = array_slice($response_decoded->customers, $perPage * ($currentPage - 1), $perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);

        }
        else {

            $currentItems = [];

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
        }

    
        return $itemsPaginate; 

    }

    public function getListagemAnalisesCliente($perPage,$page,$idCliente): LengthAwarePaginator
    {
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page='.$page.'&customer_id='.$idCliente,
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
 
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        if($response_decoded != null)
        {
            $currentItems = array_slice($response_decoded->orders, $perPage * ($currentPage - 1), $perPage);
 
            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
 
        }
        else {
 
            $currentItems = [];
 
            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
        }
 
   
        return $itemsPaginate;
    }

    public function getNumberOfPages($perPage): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page=1',
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

        $arrayInfo = [];

        $arrayInfo = ["nr_paginas" => $response_decoded->total_pages, "nr_registos" => $response_decoded->total_records];

        return $arrayInfo;
    }

    /*** FILTROS ***/

    public function getListagemClienteFiltro($perPage,$page,$nomeCliente,$numeroCliente,$zonaCliente): LengthAwarePaginator
    {

        if($nomeCliente != "") {
            $nomeCliente = '&Name='.urlencode($nomeCliente);
        } 

        if($numeroCliente != "") {
            $numeroCliente = '&Customer_number='.urlencode($numeroCliente);
        }

        if($zonaCliente != "") {
            $zonaCliente = '&Zone='.urlencode($zonaCliente);
        } 

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page='.$page.$nomeCliente.$numeroCliente.$zonaCliente,
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($response_decoded != null)
        {
            $currentItems = array_slice($response_decoded->customers, $perPage * ($currentPage - 1), $perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);

        }
        else {

            $currentItems = [];

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
        }

    
        return $itemsPaginate; 
    }

    public function getNumberOfPagesClienteFiltro($perPage,$nomeCliente,$numeroCliente,$zonaCliente): array
    {

        if($nomeCliente != "") {
            $nomeCliente = '&Name='.urlencode($nomeCliente);
        } 

        if($numeroCliente != "") {
            $numeroCliente = '&Customer_number='.urlencode($numeroCliente);
        } 

        if($zonaCliente != "") {
            $zonaCliente = '&Zone='.urlencode($zonaCliente);
        } 

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page=1'.$nomeCliente.$numeroCliente.$zonaCliente,
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


        $arrayInfo = [];

        $arrayInfo = ["nr_paginas" => $response_decoded->total_pages, "nr_registos" => $response_decoded->total_records];

        return $arrayInfo;
    }


    /**** END FILTROS ****/


    public function getDetalhesCliente($id): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?id='.$id,
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

   


    /***  DETALHES DO CLIENTE *****/

    public function getEncomendasCliente($perPage,$page,$idCliente): LengthAwarePaginator
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page='.$page.'&customer_id='.$idCliente,
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($response_decoded != null)
        {
            $currentItems = array_slice($response_decoded->orders, $perPage * ($currentPage - 1), $perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);

        }
        else {

            $currentItems = [];

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
        }

    
        return $itemsPaginate; 
    }

    public function getNumberOfPagesAnalisesCliente($perPage,$idCliente): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page=1&customer_id='.$idCliente,
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

        $arrayInfo = [];

        $arrayInfo = ["nr_paginas" => $response_decoded->total_pages, "nr_registos" => $response_decoded->total_records];

        return $arrayInfo;
    }

    public function getNumberOfPagesEncomendasCliente($perPage,$idCliente): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page=1&customer_id='.$idCliente,
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

        $arrayInfo = [];

        $arrayInfo = ["nr_paginas" => $response_decoded->total_pages, "nr_registos" => $response_decoded->total_records];

        return $arrayInfo;
    }



    
    public function getPropostasCliente($perPage,$page,$idCliente): LengthAwarePaginator
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page='.$page.'&customer_id='.$idCliente,
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if($response_decoded != null)
        {
            $currentItems = array_slice($response_decoded->orders, $perPage * ($currentPage - 1), $perPage);

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);

        }
        else {

            $currentItems = [];

            $itemsPaginate = new LengthAwarePaginator($currentItems, $response_decoded->total_pages,$perPage);
        }

    
        return $itemsPaginate; 
    }

    public function getNumberOfPagesPropostasCliente($perPage,$idCliente): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page=1&customer_id='.$idCliente,
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

        $arrayInfo = [];

        $arrayInfo = ["nr_paginas" => $response_decoded->total_pages, "nr_registos" => $response_decoded->total_records];

        return $arrayInfo;
    }



}