@extends('main')
@section('body')


    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Clientes</a></li>
                <li class="breadcrumb-item active">Listagem</li>
            </ol>
        </div>
    </div>


    @livewire('clientes.clientes')
 
    

@endsection

