<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\VisitasAgendadas;
use Illuminate\Http\JsonResponse;
use App\Interfaces\VisitasInterface;
use App\Models\Tarefas;
use App\Services\OfficeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class VisitasRepository implements VisitasInterface
{
    public function getListagemVisitas($perPage,$page): LengthAwarePaginator
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

    public function getAlgumaCoisaDasVisitas($ValorQualquer1,$ValorQualquer2,$ValorQualquer3): LengthAwarePaginator
    {
        // vinicius
        dd("Algo de errado nao está certo!");
    }
    /*** FILTROS ***/

    public function getListagemVisitasFiltro($perPage,$page,$nomeVisitas,$numeroVisitas,$zonaVisitas): LengthAwarePaginator
    {

        if($nomeVisitas != "") {
            $nomeVisitas = '&Name='.urlencode($nomeVisitas);
        }

        if($numeroVisitas != "") {
            $numeroVisitas = '&Customer_number='.urlencode($numeroVisitas);
        }

        if($zonaVisitas != "") {
            $zonaVisitas = '&Zone='.urlencode($zonaVisitas);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page='.$page.$nomeVisitas.$numeroVisitas.$zonaVisitas,
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

    public function getNumberOfPagesVisitasFiltro($perPage,$nomeVisitas,$numeroVisitas,$zonaVisitas): array
    {

        if($nomeVisitas != "") {
            $nomeVisitas = '&Name='.urlencode($nomeVisitas);
        }

        if($numeroVisitas != "") {
            $numeroVisitas = '&Customer_number='.urlencode($numeroVisitas);
        }

        if($zonaVisitas != "") {
            $zonaVisitas = '&Zone='.urlencode($zonaVisitas);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/customers/GetCustomers?perPage='.$perPage.'&Page=1'.$nomeVisitas.$numeroVisitas.$zonaVisitas,
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


    public function getDetalhesVisitas($id): object
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




    /***  DETALHES DO Visitas *****/

    public function getListagemAnalisesVisitas($perPage,$page,$idVisitas): LengthAwarePaginator
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page='.$page.'&customer_id='.$idVisitas,
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

    public function getNumberOfPagesAnalisesVisitas($perPage,$idVisitas): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://sanipower.fortiddns.com:58884/api/analytics/orders?perPage='.$perPage.'&Page=1&customer_id='.$idVisitas,
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


    public function addVisitaDatabase($clientID,$client, $dataInicial,$horaInicial, $horaFinal, $tipoVisitaEscolhido, $assuntoText): JsonResponse
    {
        $addVisita = VisitasAgendadas::create([
            "id_tipo_visita" => $tipoVisitaEscolhido,
            "client_id" => $clientID,
            "cliente" => $client,
            "data_inicial" => $dataInicial,
            "hora_inicial" => $horaInicial,
            "hora_final" => $horaFinal,
            "data_final" => $dataInicial,
            "assunto_text" => $assuntoText,
            "user_id" => Auth::user()->id,
            "finalizado" => 0
        ]);


        if ($addVisita) {
            // Inserção bem-sucedida
            return response()->json([
                'success' => true,
                'data' => $addVisita
            ], 201);
        } else {
            // Falha na inserção
            return response()->json([
                'success' => false,
                'message' => 'Falha ao inserir na base de dados.'
            ], 500);
        }

        return $addVisita;
    }

    public function getListagemVisitasAgendadas($user): object
    {
        if(Auth::user()->nivel == "3")
        {
            $visitasAgendadas = VisitasAgendadas::with('tipovisita')->get();
        } else {
            $visitasAgendadas = VisitasAgendadas::where('user_id',Auth::user()->id)->with('tipovisita')->get();
        }
        

        return $visitasAgendadas;
    }

    public function getListagemVisitasAndTarefas($user): array
    {

        $allTasks = [];

        if(Auth::user()->nivel == "3"){
            $visitasAgendadas = VisitasAgendadas::with('tipovisita')->get();
            $tarefas = Tarefas::all();
        } else {
            $visitasAgendadas = VisitasAgendadas::where('user_id',Auth::user()->id)->with('tipovisita')->get();
            $tarefas = Tarefas::where('user_id',Auth::user()->id)->get();
        }

        $allTasks["visitas"] = $visitasAgendadas;

        $allTasks["tarefas"] = $tarefas;
        

        return $allTasks;
    }

    public function getVisitasAgendadas($clientID): LengthAwarePaginator
    {
        $visitasAgendadas = VisitasAgendadas::where('finalizado','0')->where('cliente',json_decode($clientID))->paginate(10);

        return $visitasAgendadas;
    }



}
