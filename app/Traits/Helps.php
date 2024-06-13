<?php

namespace App\Traits;

trait Helps
{
    public function formatarHoraComMilissegundos($hora)
    {
        // Extrair horas, minutos, segundos e milissegundos
        list($horas, $minutos, $segundos, $milissegundos) = sscanf($hora, "%d:%d:%d.%d");

        // Formatar a hora no formato desejado, incluindo os milissegundos
        return sprintf("%02d:%02d:%02d.%03d", $horas, $minutos, $segundos, $milissegundos);
    }
}