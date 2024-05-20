@extends('main')
@section('body')

    <div class="row navigationLinks">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Clientes</a></li>
                <li class="breadcrumb-item">Informação</li>
                <li class="breadcrumb-item active">{{$nameCliente}}</li>

            </ol>
        </div>
    </div>

    @livewire('encomendas.detalhe-encomenda',["cliente" => $idCliente])

@endsection

@push('scripts_footer')

<script>

        document.addEventListener('compraRapida', function(e) {
           
            jQuery('#modalProdutos').modal();
          
        });

        document.addEventListener('encomendaAtual', function() {
           
           jQuery('#modalEncomenda').modal();
         
       });
       
</script>

@endpush
