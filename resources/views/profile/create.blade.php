@extends('main')
@section('body')
    <div class="row">
        <div class="col">
            <ol class="breadcrumb" style="padding-left: 25px;">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Utilizador</a></li>
                <li class="breadcrumb-item active">Criar</li>
            </ol>
        </div>
    </div>
    @livewire('profile.page-users')
    
@endsection
@push('scripts_footer')
<script>
    $(document).ready(function(){
        $('#abrirModalCriaUser').on('click', function(){
            $('#modalAdicionarUser').modal('show');
        });
    });
    window.addEventListener('DOMContentLoaded', (event) => {
        if ("{{ session('success') }}") {
            toastr.success("{{ session('success') }}");
        }
        if("{{ session('error') }}"){
            toastr.warning("{{ session('error') }}");
        }
    });
</script>
@endpush