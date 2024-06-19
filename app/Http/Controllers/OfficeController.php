<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OfficeService;

class OfficeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCode(Request $request)
    {
        $code = $request->query('code');
              
        $requestUri = $request->getRequestUri();

        parse_str(parse_url($requestUri, PHP_URL_QUERY), $params);
        $stateEncoded = $params['state'];
        $stateDecoded = urldecode($stateEncoded);
        $stateArray = json_decode($stateDecoded, true);

        $tenant = $stateArray['tenant'];
        $clientid = $stateArray['clientid'];
        $clientesecret = $stateArray['clientesecret'];
        $redirect = $stateArray['redirect'];
        $visitaid = $stateArray['visitaid'];
        $visitaname = $stateArray['visitaname'];
        $data = $stateArray['data'];
        $horainicial = $stateArray['horainicial'];
        $horafinal = $stateArray['horafinal'];
        $tipovisita = $stateArray['tipovisita'];
        $assunto = $stateArray['assunto'];
        $email = $stateArray['email'];
        $nameOrganizer = $stateArray['organizer'];


        $servicoOffice = new OfficeService();

        $tokenAccess = $servicoOffice->requestToken($code);

        $responseToken = json_decode($tokenAccess->getContent(), true);
        $accessToken = $responseToken['access_token'];

        $responseOut = $servicoOffice->criarEventoOutlook($visitaname,$email,$nameOrganizer, $data,$horainicial, $horafinal, $tipovisita, $assunto,$accessToken);

        echo '<script>window.close();</script>';
        //return redirect()->route('dashboard')->with('message', 'Visita adicionada com sucesso!')->with('status', 'success');
        
    }
}
