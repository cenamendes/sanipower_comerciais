<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ClientesInterface;
use Illuminate\Support\Facades\Session;

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

        return view('encomendas.details',["idCliente" => $id,"nameCliente" => $detailsClientes->customers[0]->name, "codEncomenda" => $codEncomenda, "encomenda" => null]);
    }

    public function showDetailEncomenda($idEncomenda)
    {
        if($idEncomenda == "nova")
        {
            return view('encomendas.clientes');
        } 
        else
        {
            $encomenda = Session::get('encomenda');            

            return view('encomendas.details',["idCliente" => "", "codEncomenda" => "","encomenda" => $encomenda]);
        }
       
    }

    public function encomendasList()
    {
        
        return view('encomendas.clientes');
    }
}
