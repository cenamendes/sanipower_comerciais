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

@push('scripts_footer')

<script>
     document.addEventListener('livewire:load', function() {
            Livewire.hook('message.sent', () => {
                document.getElementById('loader').style.display = 'block';
            });

            // Oculta o loader quando o Livewire terminar de carregar
            Livewire.hook('message.processed', () => {
                document.getElementById('loader').style.display = 'none';
            });
        });
</script>

@endpush