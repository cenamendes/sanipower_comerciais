
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
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header uppercase">
                <div class="caption">
                    <i class="ti-filter"></i> Filtros
                </div>
            </div>
            <div class="card-body" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="mt-2">Nome do Utilizador</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nome do Cliente" wire:model.lazy="nomeCliente">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="mt-2">Email do Utilizador</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-ticket"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Número do Cliente" wire:model.lazy="numeroCliente">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="mt-2">Telemóvel</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-microphone-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Telemóvel" wire:model.lazy="telemovelCliente">
                            </div>
                        </div>
                    </div>
                    <!-- PARTE DO ACCORDEON -->
                    {{-- <div class="row ml-0 mr-0 mt-4 d-block">
                        <div class="row ml-0 mr-0 mt-4 d-block">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left pl-0 text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="ti-plus"></i> MAIS FILTROS
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label class="mt-2">NIF</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ti-receipt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="NIF" wire:model.lazy="nifCliente">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="mt-2">Telemóvel</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ti-microphone-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Telemóvel" wire:model.lazy="telemovelCliente">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="mt-2">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ti-email"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Email" wire:model.lazy="emailCliente">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- FIM DO ACCORDEON -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header d-block">
                        <div class="row">
                            <div class="col-xl-8 col-xs-12">
                                <div class="caption uppercase">
                                    <i class="ti-user"></i> Utilizadores
                                </div>
                            </div>
                            <div class="col-xl-4 col-xs-12 text-right">
                                <button class="btn btn-primary" id="abrirModalCriaUser"><i class="ti-plus"></i> Criar Usuario</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="dataTables_wrapper" class="dataTables_wrapper container" style="margin-left:0px;padding-left:0px;margin-bottom:10px;">
                            <div class="left">
                                <label>Mostrar
                                    <select name="perPage" wire:model="perPage">
                                        <option value="10">10</option>
                                    </select>
                                    registos</label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover init-datatable" id="tabela-cliente">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nome do Utilizador</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Nível de Acesso</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr data-href="#">
                                        <td>
                                            <div style="display: flex;align-items: center;">
                                                @if ($user->imagem == null || $user->imagem == '')
                                                    <div class="img-temporary-navbar" style="width: 42px;height: 42px;margin-right: 10px;">{{ ucfirst(substr($user->name, 0, 1)) }}</div>
                                                @else
                                                    <img class="img-navbar" style="width: 42px;height: 42px;margin-right: 10px;" src="{{ asset('storage/profile/' . $user->imagem) }}" alt=""/>
                                                @endif
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->telefone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nivel }}</td>
                                        <td>
                                            @if($user->status == "Inactivo")
                                                <button class="btn btn-sm btn-chili btn-round" disabled>{{ $user->status }}</button>
                                            @else
                                                <button class="btn btn-sm btn-jade btn-round" disabled>{{ $user->status }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarUser{{$user->id}}">
                                                <i class="fas fa-user-cog"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modalEditarUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditarUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditarUserLabel">Editar Usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @livewire('profile.edit-profile', ['userId' => $user->id])
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAdicionarUser" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdicionarUserLabel">Adicionar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('profile.create-profile')
            </div>
        </div>
    </div>
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