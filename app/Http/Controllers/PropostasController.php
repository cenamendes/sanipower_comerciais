<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;


class PropostasController extends Controller
{
    private ?object $clientesRepository = NULL;
    public function __construct(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    
    public function index()
    {
        return view('propostas.index');
    }

    public function showDetail($id)
    {
        Session::put('rota','propostas.nova');

        $detailsClientes = $this->clientesRepository->getDetalhesCliente($id);
        $checkCarrinho = Carrinho::where("id_user", Auth::user()->id)
                        ->where('id_cliente',$detailsClientes->customers[0]->no)
                        ->where('id_proposta','!=','')->first();
        if(empty($checkCarrinho)){

            $codEncomenda = $detailsClientes->customers[0]->no;

            $randomChar = Str::random(1);
            $codEncomenda .= $randomChar;
        }else{
            $codEncomenda = $checkCarrinho->id_proposta;
        }
        return view('propostas.details',["idCliente" => $id, "nameCliente" => $detailsClientes->customers[0]->name, "codEncomenda" => $codEncomenda, "proposta" => null]);
    }

    public function showDetailProposta($idProposta)
    {
        if($idProposta == "nova")
        {
            return view('propostas.clientes');
        } 
        else
        {
            $proposta = Session::get('proposta');
            return view('propostas.details',["idCliente" => "", "codEncomenda" => "","proposta" => $proposta]);
        }
       
    }

    public function propostasList()
    {
        return view('propostas.clientes');
    }
}
