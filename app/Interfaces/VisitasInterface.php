<?php

namespace App\Interfaces;

use App\Models\VisitasAgendadas;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface VisitasInterface
{
    public function getListagemVisitas($perPage,$page): LengthAwarePaginator;

    public function getNumberOfPages($perPage): array;

    public function getAlgumaCoisaDasVisitas($ValorQualquer1,$ValorQualquer2,$ValorQualquer3): LengthAwarePaginator;

    /** FILTRO POR Visitas */

    public function getListagemVisitasFiltro($perPage,$page,$nomeVisitas,$numeroVisitas,$zonaVisitas): LengthAwarePaginator;

    public function getNumberOfPagesVisitasFiltro($perPage,$nomeVisitas,$numeroVisitas,$zonaVisitas): array;

    /*********** */

    //** DETLAHES Visitas */

    public function getDetalhesVisitas($id_Visitas): object;

    public function getListagemAnalisesVisitas($perPage,$page,$idVisitas): LengthAwarePaginator;

    public function getNumberOfPagesAnalisesVisitas($perPage,$idVisitas): array;

    /****** */


    /** ADD VISITA */

    
    public function addVisitaDatabase($clientID,$client,$dataInicial,$horaInicial, $horaFinal, $tipoVisitaEscolhido, $assuntoText): JsonResponse;

    public function getListagemVisitasAgendadas($user): object;

    public function getListagemVisitasAndTarefas($user): array;
    
    /*** */

    /*** GET VISITAS AGENDADAS ***/

    public function getVisitasAgendadas($clientID): LengthAwarePaginator; 

    /******** */

}
