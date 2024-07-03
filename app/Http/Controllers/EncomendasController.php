<?php

namespace App\Http\Controllers;

use App\Interfaces\ClientesInterface;
use App\Models\Carrinho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EncomendasController extends Controller
{
    
    private ?object $clientesRepository = NULL;
    public function __construct(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }
    public function index()
    {
        return view('encomendas.index');
    }

    public function showDetail($id)
    {
        $detailsClientes = $this->clientesRepository->getDetalhesCliente($id);
        $checkCarrinho = Carrinho::where("id_user", Auth::user()->id)
                        ->where('id_cliente',$detailsClientes->customers[0]->no)
                        ->where('id_encomenda','!=','')->first();

        if(empty($checkCarrinho)){
            $codEncomenda = $detailsClientes->customers[0]->no;
            $randomChar = mt_rand(1000000, 9999999);
            $codEncomenda .= $randomChar;
        }else{
            $codEncomenda = $checkCarrinho->id_encomenda;
        }

        return view('encomendas.details',["idCliente" => $id,"nameCliente" => $detailsClientes->customers[0]->name, "codEncomenda" => $codEncomenda]);
    }
}
