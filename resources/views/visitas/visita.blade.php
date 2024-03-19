@extends('main')
@section('body')

    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-calendar"></i> Visitas</a></li>
                <li class="breadcrumb-item">Listagem</li>
                <li class="breadcrumb-item">Criar visita</li>
                <li class="breadcrumb-item active">{{$idCliente}}</li>
            </ol>
        </div>
    </div>
    
    @livewire('visitas.new-visita',["cliente" => $idCliente])

@endsection