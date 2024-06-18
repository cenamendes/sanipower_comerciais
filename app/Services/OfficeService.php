<?php

namespace App\Services;

use App\Models\TiposVisitas;
use Illuminate\Support\Facades\Auth;
use App\Traits\Helps;

class OfficeService
{
    use Helps;

    public function criarEventoOutlook($client, $dataInicial,$horaInicial, $horaFinal, $tipoVisitaEscolhido, $assuntoText)
    {

        $tiposVisita = TiposVisitas::where('id',$tipoVisitaEscolhido)->first();

        $accessToken = Auth::user()->token;
        
        $curl = curl_init();

        $data = '{
            "subject": "'.$assuntoText.' - '.$client.'",
            "start": {
                "dateTime": "'.$dataInicial.'T'.$this->formatarHoraComMilissegundos($horaInicial).'Z",
                "timeZone": "UTC"
            },
            "end": {
                "dateTime": "'.$dataInicial.'T'.$this->formatarHoraComMilissegundos($horaFinal).'Z",
                "timeZone": "UTC"
            },
            "location" : {
                "displayName": "'.$tiposVisita->tipo.'"
            },
            "organizer" : {
                "emailAddress": {
                     "address": "'.Auth::user()->email.'",
                     "name": "'.Auth::user()->name.'",
                },
            },
        }';

     
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/me/events',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_decoded = json_decode($response);

        return $response_decoded;
    }

}