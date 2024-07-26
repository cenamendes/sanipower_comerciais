@extends('main')
@section('body')

    <div class="row navigationLinks">
        <div class="col">
            <ol class="breadcrumb pl-4" style="padding-left: 25px;">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Clientes</a></li>
                <li class="breadcrumb-item">Proposta Cliente</li>
                @if(isset($nameCliente))
                    <li class="breadcrumb-item active">{{$nameCliente}}</li>
                @else
                    <li class="breadcrumb-item active">{{$proposta->name}}</li>
                @endif

            </ol>
        </div>
    </div>

    <div>
        @if($proposta != null)
            @livewire('propostas.proposta-info',["proposta" => $proposta])
        @else
            @livewire('propostas.detalhe-proposta',["cliente" => $idCliente, "codEncomenda" => $codEncomenda])
        @endif
    </div>
    


@endsection

@push('scripts_footer')

{{-- <script src="{{asset('assets/scripts/pages/cp_datetime.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script>

        document.addEventListener('encomendaAtual', function() {


           jQuery('#modalEncomenda').modal();
         
        });

        window.addEventListener('beforeunload', function () {
            // Show the loader when the user navigates away or the page is being unloaded
            document.getElementById('loader').style.display = 'block';
        });

        
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.sent', () => {
                document.getElementById('loader').style.display = 'block';
            });

            // Oculta o loader quando o Livewire terminar de carregar
            Livewire.hook('message.processed', () => {
                document.getElementById('loader').style.display = 'none';
            });
        });


        window.addEventListener('checkToaster', function(e) {
    
            jQuery("#modalProdutos").modal('hide');
            jQuery("#modalEncomenda").modal('hide');
            jQuery("#modalProposta").modal('hide');
            jQuery("#modalComentario").modal('hide');     
            

            if (e.detail.status == "success") {
                toastr.success(e.detail.message);
            }

            if(e.detail.status == "error"){
                toastr.warning(e.detail.message);
            }
        });

        
       
</script>

@endpush
