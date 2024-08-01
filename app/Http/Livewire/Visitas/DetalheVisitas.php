<?php

namespace App\Http\Livewire\Visitas;

use App\Models\Visitas;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VisitasAgendadas;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ClientesInterface;
use App\Interfaces\VisitasInterface;
use App\Models\TiposVisitas;
use Illuminate\Support\Facades\Session;

class DetalheVisitas extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    private ?object $visitasRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    public int $perPage = 10;
    public int $perPageRelatorio = 10;

    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    private ?object $detailsClientes = NULL;
    private ?object $analysisClientes = NULL;

    public string $tabDetail = "show active";
    public string $tabAnalysis = "";
    public string $tabEncomendas = "";
    public string $tabPropostas = "";
    public string $tabFinanceiro = "";
    public string $tabOcorrencia = "";
    public string $tabVisitas = "";
    public string $tabAssistencias = "";

    //FORM
    public string $assunto = "";
    public string $relatorio = "";
    public string $pendentes = "";
    public string $comentario_encomendas = "";
    public string $comentario_propostas = "";
    public string $comentario_financeiro = "";
    public string $comentario_occorencias = "";
    public int $checkStatus;

    private ?object $encomendasDetail = NULL;

    public ?string $activeFinalizado = "";

    public $tiposVisitaCollection;
    public int $tipoVisitaSelect;

    public ?int $idVisita;
    public ?string $clientID = "";
    protected $listeners = ['eventoChamarSaveVisita' => 'saveVisita'];
    public function boot(ClientesInterface $clientesRepository, VisitasInterface $visitasRepository)
    {
        $this->clientesRepository = $clientesRepository;
        $this->visitasRepository = $visitasRepository;
    }

    private function initProperties(): void
    {
        if (isset($this->perPage)) {
            session()->put('perPage', $this->perPage);
        } elseif (session('perPage')) {
            $this->perPage = session('perPage');
        } else {
            $this->perPage = 10;
        }

    }

    public function mount($cliente, $idVisita = null, $tst)
    {
        $this->initProperties();
        $this->idCliente = $cliente;

        if($idVisita != 0){
            $this->idVisita = $idVisita;
            
            $visita = Visitas::where('id_visita_agendada',$idVisita)->first();
            $visitaAgendada = VisitasAgendadas::where('id', $idVisita)->first();


            if(isset($visita->assunto))
            {
                if($visita->assunto == "")
                {
                    $this->assunto = $visitaAgendada->assunto_text;
                } else {
                    $this->assunto = $visita->assunto;
                }
               
            } else {
                $this->assunto = $visitaAgendada->assunto_text;
            }

            if(isset($visita->relatorio))
            {
                $this->relatorio = $visita->relatorio;
            }

            if(isset($visita->pendentes_proxima_visita))
            {
                $this->pendentes = $visita->pendentes_proxima_visita;
            }

            if(isset($visita->comentario_encomendas))
            {
                $this->comentario_encomendas = $visita->comentario_encomendas;
            }

            if(isset($visita->comentario_propostas))
            {
                $this->comentario_propostas = $visita->comentario_propostas;
            }
         
            if(isset($visita->comentario_financeiro))
            {
                $this->comentario_financeiro = $visita->comentario_financeiro;
            }
          
            if(isset($visita->comentario_ocorrencias))
            {
                $this->comentario_occorencias = $visita->comentario_ocorrencias;
            }

            if(isset($visitaAgendada->finalizado))
            {
                $this->checkStatus = $visitaAgendada->finalizado;
            }

            if(isset($visitaAgendada->id_tipo_visita))
            {
                $this->tipoVisitaSelect = $visitaAgendada->id_tipo_visita;
            }
            
         
    
        } else {
            $this->checkStatus = 0;
            $this->tipoVisitaSelect = 1;
        }

       

        $this->activeFinalizado = $tst;
        $this->restartDetails();

    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];

        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
    }


    public function previousPage()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];


        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
    }

    public function nextPage()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];


        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";
    }

    public function getPageRange()
    {
        $currentPage = $this->pageChosen;
        $lastPage = $this->numberMaxPages;

        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);

        return range($start, $end);
    }

    public function isCurrentPage($page)
    {
        return $page == $this->pageChosen;
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
        session()->put('perPage', $this->perPage);


        $this->tabRelatorio = "";
        $this->tabDetail = "";
        $this->tabAnalysis = "show active";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";

        $this->restartDetails();

    }
    public function updatedPerPageRelatorio(): void
    {
        $this->resetPage();
        session()->put('perPageRelatorio', $this->perPageRelatorio);


        $this->tabRelatorio = "show active";
        $this->tabDetail = "";
        $this->tabAnalysis = "";
        $this->tabEncomendas = "";
        $this->tabPropostas = "";
        $this->tabFinanceiro = "";
        $this->tabOcorrencia = "";
        $this->tabVisitas = "";
        $this->tabAssistencias = "";


        $this->restartDetails();

    }

    public function restartDetails()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);
        $this->detailsClientes = $arrayCliente["object"];
       
        // $getInfoClientes = $this->clientesRepository->getNumberOfPagesAnalisesCliente($this->perPageRelatorio,$this->idCliente);

        $this->numberMaxPages = $arrayCliente["nr_paginas"] + 1;
        $this->totalRecords = $arrayCliente["nr_registos"];
    }

    public function guardarVisita()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->detailsClientes = $arrayCliente["object"];

        $visitas = Visitas::where('id_visita_agendada',$this->idVisita)->first();

        if($visitas != null)
        {
            if($visitas->count() > 0)
            {
                
                $agenda = VisitasAgendadas::where('id',$this->idVisita)->update([
                    "finalizado" => "2",
                    "assunto_text" => $this->assunto,
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);

                $getId = VisitasAgendadas::where('id',$this->idVisita)->first();

            
                $visitaCreate = Visitas::where('id_visita_agendada',$this->idVisita)->update([
                    "id_visita_agendada" => $getId->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);


                if(!empty($visitaCreate)) {
                    session()->flash('success', "Visita atualizada com sucesso");
                    return redirect()->route('visitas.info',["id" => $this->idVisita]);
        
                } else {
                    session()->flash('warning', "Não foi possivel alterar a visita!");
                    return redirect()->route('visitas.info',["id" => $this->idVisita]);
                }

            } 
            else 
            {

                $agenda = VisitasAgendadas::create([
                    "client_id" => $this->detailsClientes->customers[0]->id,
                    "cliente" => $this->detailsClientes->customers[0]->name,
                    "data_inicial" => date('Y-m-d'),
                    "hora_inicial" => date('H:i'),
                    "user_id" => Auth::user()->id,
                    "assunto_text" => $this->assunto,
                    "finalizado" => "2",
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);



                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $agenda->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);

        
                
                if(!empty($visitaCreate)) {
                    session()->flash('success', "Visita registada com sucesso");
                    return redirect()->route('visitas.info',["id" => $agenda->id]);
        
                } else {
                    session()->flash('warning', "Não foi possivel adicionar visita!");
                    return redirect()->route('visitas.info',["id" => $agenda->id]);
                }

            }
        }
        else 
        {
          
            if($this->idVisita == 0)
            {
                $agenda = VisitasAgendadas::create([
                    "client_id" => $this->detailsClientes->customers[0]->id,
                    "cliente" => $this->detailsClientes->customers[0]->name,
                    "assunto_text" => $this->assunto,
                    "data_inicial" => date('Y-m-d'),
                    "hora_inicial" => date('H:i'),
                    "user_id" => Auth::user()->id,
                    "finalizado" => "2",
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);


                $getId = VisitasAgendadas::where('id',$agenda->id)->first();
    
                    
                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $agenda->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);
            }
            else 
            {
                $agenda = VisitasAgendadas::where('id',$this->idVisita)->update([
                    "assunto_text" => $this->assunto,
                    "finalizado" => "2",
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);
    
                $getId = VisitasAgendadas::where('id',$this->idVisita)->first();
    
                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $getId->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);
            }
           
           
            if(!empty($visitaCreate)) {
                session()->flash('success', "Visita registada com sucesso");
                return redirect()->route('visitas.info',["id" => $getId->id]);
    
            } else {
                session()->flash('warning', "Não foi possivel adicionar visita!");
                return redirect()->route('visitas.info',["id" => $getId->id]);
            }

        }
       
        

    }

    public function finalizarVisita()
    {
        $arrayCliente = $this->clientesRepository->getDetalhesCliente($this->idCliente);

        $this->detailsClientes = $arrayCliente["object"];

        $visitas = Visitas::where('id_visita_agendada',$this->idVisita)->first();

        if($visitas != null)
        {

            if($visitas->count() > 0)
            {
                $agenda = VisitasAgendadas::where('id',$this->idVisita)->update([
                    "finalizado" => "1",
                    "data_final" => date('Y-m-d'),
                    "hora_final" => date('H:i'),
                    "assunto_text" => $this->assunto,
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);

                $getId = VisitasAgendadas::where('id',$this->idVisita)->first();

                $visitaCreate = Visitas::where('id_visita_agendada',$this->idVisita)->update([
                    "id_visita_agendada" => $getId->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);

             
            } 
            else {

                $agenda = VisitasAgendadas::create([
                    "client_id" => $this->detailsClientes->customers[0]->id,
                    "cliente" => $this->detailsClientes->customers[0]->name,
                    "data_inicial" => date('Y-m-d'),
                    "hora_inicial" => date('H:i'),
                    "data_final" => date('Y-m-d'),
                    "hora_final" => date('H:i'),
                    "user_id" => Auth::user()->id,
                    "assunto_text" => $this->assunto,
                    "finalizado" => "1",
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);


                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $agenda->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);

            }
        }
        else {

            if($this->idVisita == 0)
            {

                $agenda = VisitasAgendadas::create([
                    "client_id" => $this->detailsClientes->customers[0]->id,
                    "cliente" => $this->detailsClientes->customers[0]->name,
                    "assunto_text" => $this->assunto,
                    "data_inicial" => date('Y-m-d'),
                    "hora_inicial" => date('H:i'),
                    "data_final" => date('Y-m-d'),
                    "hora_final" => date('H:i'),
                    "user_id" => Auth::user()->id,
                    "finalizado" => "1",
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);
    
                    
                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $agenda->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);

            }
            else {

                $agenda = VisitasAgendadas::where('id',$this->idVisita)->update([
                    "finalizado" => "1",
                    "data_final" => date('Y-m-d'),
                    "hora_final" => date('H:i'),
                    "assunto_text" => $this->assunto,
                    "id_tipo_visita" => $this->tipoVisitaSelect
                ]);
    
                $getId = VisitasAgendadas::where('id',$this->idVisita)->first();
    
                $visitaCreate = Visitas::create([
                    "id_visita_agendada" => $getId->id,
                    "numero_cliente" => $this->detailsClientes->customers[0]->no,
                    "assunto" => $this->assunto,
                    "relatorio" => $this->relatorio,
                    "pendentes_proxima_visita" => $this->pendentes,
                    "comentario_encomendas" => $this->comentario_encomendas,
                    "comentario_propostas" => $this->comentario_propostas,
                    "comentario_financeiro" => $this->comentario_financeiro,
                    "comentario_ocorrencias" => $this->comentario_occorencias,
                    "data" => date('Y-m-d'),
                    "user_id" => Auth::user()->id
                ]);

            }

        }

        $dataPHC = date('Y-m-d')."T".date('H:i:s');

        $getVisitaID = VisitasAgendadas::where('id',$this->idVisita)->first();
      
        $tipoVisita = TiposVisitas::where('id',$this->tipoVisitaSelect)->first();

        $sendPHC = $this->visitasRepository->sendVisitaToPhc($getVisitaID->id, $this->detailsClientes->customers[0]->id, $this->assunto, $this->relatorio, $tipoVisita->tipo,$this->pendentes, $this->comentario_encomendas, $this->comentario_propostas, $this->comentario_financeiro, $this->comentario_occorencias, $dataPHC);


        $responseArray = $sendPHC->getData(true);
        
        if($responseArray["success"] == true){

            session()->flash('success', "Visita registada e finalizada com sucesso");
            return redirect()->route('visitas.info',["id" => $getVisitaID->id]);
        }
        else {
            
            session()->flash('warning', "Não foi possivel adicionar visita!");
            return redirect()->route('visitas.info',["id" => $getVisitaID->id]);
        }

      
      

    }

    public function openModalSaveVisita()
    {
        $this->restartDetails();
        if($this->activeFinalizado == "1"){ //finalizar

        
            $response = $this->clientesRepository->storeVisita($this->idVisita, $this->detailsClientes->customers[0]->no,$this->assunto,$this->relatorio,$this->pendentes,$this->comentario_encomendas,$this->comentario_propostas,$this->comentario_financeiro,$this->comentario_occorencias);
            
            $responseArray = $response->getData(true);
            VisitasAgendadas::where('id', $this->idVisita)->update(['finalizado' => 1]);
            if($responseArray["success"] == true){
                session()->flash('success', "Visita registada com sucesso");
            } else {
                if($responseArray["type"] == "1")
                {
                    session()->flash('error', $responseArray["data"]);
                } else {
                    session()->flash('error', "Não foi possivel adicionar a visita");
                }
            }

            $this->skipRender();
            
            return redirect()->route('visitas');
        }else if($this->activeFinalizado == "2"){ // adicionar
            $this->dispatchBrowserEvent('listagemDetalherVisitasModal');
        }
        
    }
    public function saveVisita($id = null)
    {
        $this->restartDetails();
        if($this->idVisita != 0) {
            $response = $this->clientesRepository->storeVisita($this->idVisita, $this->detailsClientes->customers[0]->no,$this->assunto,$this->relatorio,$this->pendentes,$this->comentario_encomendas,$this->comentario_propostas,$this->comentario_financeiro,$this->comentario_occorencias);
            
        }
        

        if($id != null) {
            $this->idVisita = $id['visitaId'];
            $response = $this->clientesRepository->storeVisita($this->idVisita, $this->detailsClientes->customers[0]->no,$this->assunto,$this->relatorio,$this->pendentes,$this->comentario_encomendas,$this->comentario_propostas,$this->comentario_financeiro,$this->comentario_occorencias);
            VisitasAgendadas::where('id', $id)->update(['finalizado' => 1]);
        }
        $responseArray = $response->getData(true);
        

        if($responseArray["success"] == true){
            session()->flash('success', "Visita registada com sucesso");
        } else {
            if($responseArray["type"] == "1")
            {
                session()->flash('error', $responseArray["data"]);
            } else {
                session()->flash('error', "Não foi possivel adicionar a visita");
            }
        }

        $this->skipRender();
        
        return redirect()->route('visitas');
        

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }
    public function voltarAtras()
    {
        // $this->dispatchBrowserEvent('changeRoute');
        // $this->skipRender();

        $rota = Session::get('rota');

        $parametro = Session::get('parametro');
     
        if($rota != "")
        {
            
            if($parametro != "")
            {
                return redirect()->route($rota,$parametro);
            }

            return redirect()->route($rota);

        
        }
    }
    public function render()
    {
        $this->tiposVisitaCollection = TiposVisitas::all();
        
        $getVisitaID = VisitasAgendadas::where('id',$this->idVisita)->first();
        return view('livewire.visitas.detalhe-visitas',["detalhesCliente" => $this->detailsClientes, "analisesCliente" => $this->analysisClientes, "getVisita" => $getVisitaID]);
    }
}
