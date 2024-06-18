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

    public function requestToken($code)
    {
        
        $tenant = env('MICROSOFT_TENANT');
        $clientId = env('MICROSOFT_CLIENT_ID');
        $clientSecret = env('MICROSOFT_CLIENT_SECRET');
        $redirectUri = env('MICROSOFT_REDIRECT');

        $url = "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/token";
        $data = http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return response()->json(['error' => $error], 500);
        }

        $responseDecoded = json_decode($response, true);

        if (isset($responseDecoded['error'])) {
            return response()->json(['error' => $responseDecoded['error_description']], 500);
        }


        return response()->json([
            'access_token' => $responseDecoded['access_token']
        ]);
    }

}