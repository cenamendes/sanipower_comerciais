@extends('main')
@section('body')


    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-calendar"></i> Visitas</a></li>
                <li class="breadcrumb-item active">Listagem</li>
            </ol>
        </div>
    </div>


    @livewire('visitas.visitas')
 
    

@endsection

