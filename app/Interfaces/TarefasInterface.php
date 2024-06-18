<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface TarefasInterface
{
    
    
    public function changeStatusTarefa($idTarefa,$newStatus): JsonResponse;

    public function changeTarefaInformation($idTarefa, $cliente, $assunto, $descricao): JsonResponse;

    public function addNewTarefa($cliente,$dataInicialTarefa,$horaInicialTarefa, $horaFinalTarefa, $assuntoTarefa, $descricaoTarefa): JsonResponse;
    
    public function getListagemCliente($perPage): object;

    public function getDetalhesCliente($id): object;

}
