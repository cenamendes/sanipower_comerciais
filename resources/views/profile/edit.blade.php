
@extends('main')
@section('body')
    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="ti-user"></i> Utilizador</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>
    </div>


    <div class="py-12" style="background-color: #2a2f34;">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.imagem-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts_footer')
<script>
   
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