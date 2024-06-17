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

    


}
