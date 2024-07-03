<?php

namespace App\Repositories;

use App\Interfaces\TarefasInterface;
use App\Models\User;
use App\Models\VisitasAgendadas;
use Illuminate\Http\JsonResponse;
use App\Interfaces\VisitasInterface;
use App\Models\Tarefas;
use App\Services\OfficeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class TarefasRepository implements TarefasInterface
{
  
    public function changeStatusTarefa($idTarefa,$newStatus): JsonResponse
    {
        $changeStatus = Tarefas::where('id',$idTarefa)->update([
            "finalizado" => $newStatus,
        ]);

    
        if ($changeStatus) {
            // Inserção bem-sucedida
            return response()->json([
                'success' => true,
                'data' => $changeStatus
            ], 201);
        } else {
            // Falha na inserção
            return response()->json([
                'success' => false,
                'message' => 'Falha ao inserir na base de dados.'
            ], 500);
        }

        return $changeStatus;
    }

    public function changeTarefaInformation($idTarefa, $cliente, $assunto, $descricao): JsonResponse
    {
        $changeInformation = Tarefas::where('id',$idTarefa)->update([
            "cliente" => $cliente,
            "assunto_text" => $assunto,
            "descricao" => $descricao
        ]);

    
        if ($changeInformation) {
            // Inserção bem-sucedida
            return response()->json([
                'success' => true,
                'data' => $changeInformation
            ], 201);
        } else {
            // Falha na inserção
            return response()->json([
                'success' => false,
                'message' => 'Falha ao inserir na base de dados.'
            ], 500);
        }

        return $changeInformation;
    }

    public function addNewTarefa($clienteTarefa,$dataInicialTarefa,$horaInicialTarefa, $horaFinalTarefa, $assuntoTarefa, $descricaoTarefa): JsonResponse
    {
        $newTarefa = Tarefas::create([
            "cliente" => $clienteTarefa,
            "assunto_text" => $assuntoTarefa,
            "descricao" => $descricaoTarefa,
            "data_inicial" => $dataInicialTarefa,
            "hora_inicial" => $horaInicialTarefa,
            "hora_final" => $horaFinalTarefa,
            "user_id" => Auth::user()->id,
            "finalizado" => 0
        ]);

    
        if ($newTarefa) {
            // Inserção bem-sucedida
            return response()->json([
                'success' => true,
                'data' => $newTarefa
            ], 201);
        } else {
            // Falha na inserção
            return response()->json([
                'success' => false,
                'message' => 'Falha ao inserir na base de dados.'
            ], 500);
        }

        return $newTarefa;
    }

    public function getListagemCliente($perPage): object
    {
        $nomeCliente = '&Name=';
        $numeroCliente = '&Customer_number=0';
        $zonaCliente = '&Zone=';
        $mobileCliente = '&Mobile_phone=';
        $emailCliente = '&Email=';
        $nifCliente = '&Nif=';

        $string = $nomeCliente.$numeroCliente.$zonaCliente.$mobileCliente.$emailCliente.$nifCliente;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('SANIPOWER_URL_DIGITAL').'/api/customers/GetCustomers?perPage=10000&Page=1&Salesman_number='.Auth::user()->id_phc.$string,
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

    public function getDetalhesCliente($id): object
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('SANIPOWER_URL_DIGITAL').'/api/customers/GetCustomers?id='.$id,
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


    


}
