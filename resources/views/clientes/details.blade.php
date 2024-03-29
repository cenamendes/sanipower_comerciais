@extends('main')
@section('body')

    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Clientes</a></li>
                <li class="breadcrumb-item">Informação</li>
                <li class="breadcrumb-item active">{{$idCliente}}</li>
            </ol>
        </div>
    </div>
    
    @livewire('clientes.detalhe-cliente',["cliente" => $idCliente])

@endsection
