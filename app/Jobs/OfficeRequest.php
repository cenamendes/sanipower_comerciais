<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;

class OfficeRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $tenant;
    public $clientId;
    public $redirectUri;
    public $visitaID;
    public $visitaName;
    public $dataInicialVisita;
    public $horaInicialVisita;
    public $horaFinalVisita;
    public $tipoVisita;
    public $assuntoVisita;


    public function __construct($tenant,$clientId,$redirectUri,$visitaID,$visitaName,$dataInicialVisita,$horaInicialVisita,$horaFinalVisita,$tipoVisita,$assuntoVisita)
    {
        $this->tenant = $tenant;
        $this->clientId = $clientId;
        $this->redirectUri = $redirectUri;
        $this->visitaID = $visitaID;
        $this->visitaName = $visitaName;
        $this->dataInicialVisita = $dataInicialVisita;
        $this->horaInicialVisita = $horaInicialVisita;
        $this->tipoVisita = $tipoVisita;
        $this->assuntoVisita = $assuntoVisita;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = Http::get("https://login.microsoftonline.com/".$this->tenant."/oauth2/v2.0/authorize?client_id=".$this->clientId."&response_type=code&redirect_uri=".$this->redirectUri."&response_mode=query&scope=Calendars.ReadWrite");
            
            // Trate a resposta aqui, se necessário
            $statusCode = $response->status();
            $responseData = $response->json();

            \Log::info($this->tenant);
            \Log::info($this->clientId);
            
            // Registre o sucesso, se necessário
           
        } catch (RequestException $e) {
            // Capture e trate erros de requisição
            $statusCode = $e->response->status();
            $errorMessage = $e->getMessage();
                
        }
    }
}
