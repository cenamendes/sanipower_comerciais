<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
        
        return view('propostas.details',["idCliente" => $id, "nameCliente" => $detailsClientes->customers[0]->name, "codEncomenda" => $codEncomenda]);
    }
}
