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

@push('scripts_footer')
    <script src="{{asset('assets/scripts/pages/tb_datatables.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtém todas as linhas da tabela
            const tableRows = document.querySelectorAll('tr[data-href]');

            // Adiciona um ouvinte de evento de clique a cada linha
            tableRows.forEach(function(row) {
                row.addEventListener('click', function() {
                    // Obtém o URL de destino do atributo data-href
                    const href = row.dataset.href;

                    // Redireciona o usuário para o URL de destino
                    window.location.href = href;
                });
            });
        });
    </script>
@endpush