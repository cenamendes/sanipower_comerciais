@extends('main')
@section('body')

    <div class="row navigationLinks">
        <div class="col">
            <ol class="breadcrumb pl-4" style="padding-left: 25px;">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Clientes</a></li>
                <li class="breadcrumb-item">Proposta Cliente</li>
                <li class="breadcrumb-item active">{{$nameCliente}}</li>
            </ol>
        </div>
    </div>
    
    @livewire('propostas.detalhe-proposta',["cliente" => $idCliente])

@endsection

@push('scripts_footer')

<script>
    
    document.addEventListener('compraRapida', function() {
           
           jQuery('#modalProdutos').modal();
         
       });

    document.addEventListener('encomendaAtual', function() {
          
          jQuery('#modalEncomenda').modal();
        
      });

      window.addEventListener('beforeunload', function () {
            // Show the loader when the user navigates away or the page is being unloaded
            document.getElementById('loader').style.display = 'block';
    });
      
</script>

@endpush
