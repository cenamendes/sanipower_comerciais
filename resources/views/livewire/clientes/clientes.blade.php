<div>
    <!--  LOADING -->

    <div id="loader" style="display: none;">
        <div class="loader" role="status">

        </div>
    </div>

    <!-- FIM LOADING -->

    <!--  INICIO FILTRO  -->

    <div class="row">
        <div class="col-12">
            <div class="card mb-3">

                <div class="card-header uppercase">
                    <div class="caption">
                        <i class="ti-filter"></i> Filtros
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">

                        <div class="row">

                            <div class="col-lg-4">
                                <label class="mt-2">Nome do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome do Cliente"
                                        wire:model.lazy="nomeCliente">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="mt-2">Número do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-ticket"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número do Cliente"
                                        wire:model.lazy="numeroCliente">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="mt-2">Zona</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pin2"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Zona"
                                        wire:model.lazy="zonaCliente">
                                </div>
                            </div>

                        </div>

                        <div class="row ml-0 mr-0 mt-4 d-block">

                            <!-- PARTE DO ACCORDEON -->
                            <div class="row ml-0 mr-0 mt-4 d-block">

                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button
                                                    class="btn btn-link btn-block text-left pl-0 text-decoration-none"
                                                    type="button" data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
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
                                                                <span class="input-group-text"><i
                                                                        class="ti-receipt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="NIF"
                                                                wire:model.lazy="nifCliente">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <label class="mt-2">Telemóvel</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="ti-microphone-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                placeholder="Telemóvel"
                                                                wire:model.lazy="telemovelCliente">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <label class="mt-2">Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="ti-email"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                placeholder="Email" wire:model.lazy="emailCliente">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- FIM DO ACCORDEON -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FIM FILTRO  -->

    <!-- TABELA  -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-xl-8 col-xs-12">
                            <div class="caption uppercase">
                                <i class="ti-user"></i> Clientes
                            </div>
                        </div>
                        <div class="col-xl-4 col-xs-12 text-right">

                            <div class="tools">
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"
                                    wire:click="criarCliente"><i class="ti-user"></i> Criar Cliente</a>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <div id="dataTables_wrapper" class="dataTables_wrapper container"
                        style="margin-left:0px;padding-left:0px;margin-bottom:10px; text-align:left;">
                        <div class="left">
                            <label>Mostrar
                                <select name="perPage" wire:model="perPage">
                                    <option value="10" @if ($perPage == 10) selected @endif>10
                                    </option>
                                    <option value="25" @if ($perPage == 25) selected @endif>25
                                    </option>
                                    <option value="50" @if ($perPage == 50) selected @endif>50
                                    </option>
                                    <option value="100" @if ($perPage == 100) selected @endif>100
                                    </option>
                                </select>
                                registos</label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover init-datatable" id="tabela-cliente">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nome do Cliente</th>
                                    <th>Número do Cliente</th>
                                    <th>Zona do Cliente</th>
                                    <th>Nº Contribuinte</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($clientes as $clt)
                                    <tr data-href="{{ route('clientes.detail', $clt->id) }}">
                                        <td>{{ $clt->name }}</td>
                                        <td>{{ $clt->no }}</td>
                                        <td>{{ $clt->zone }}</td>
                                        <td>{{ $clt->nif }}</td>
                                        <td>
                                            <a href="{{ route('clientes.detail', $clt->id) }}"
                                                class="btn btn-primary">
                                                <i class="ti-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>

    </div>

    <!-- FIM TABELA  -->

    <!-- MODAL -->

    <div class="modal fade" id="criarCliente" tabindex="-1" role="dialog" aria-labelledby="criarCliente"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalCliente">Criar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-12">
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <label for="criarnomeCliente">Nome do Cliente</label>
                                <input type="text" id="criarnomeCliente" class="form-control"
                                    wire:model.defer="criarnomeCliente">
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <label for="criarnumeroCliente">Número do Cliente</label>
                                <input type="text" id="criarnumeroCliente" class="form-control"
                                    wire:model.defer="criarnumeroCliente">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <label for="criarzonaCliente">Zona do Cliente</label>
                                <input type="text" id="criarzonaCliente" class="form-control"
                                    wire:model.defer="criarzonaCliente">
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <label for="criarnumContribuinte">Nº Contribuinte</label>
                                <input type="text" id="criarnumContribuinte" class="form-control"
                                    wire:model.defer="criarnumContribuinte">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-outline-primary"
                            wire:click="salvarCliente">Criar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIM MODAL -->
    </div>

    <script>
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

        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.sent', () => {
                document.getElementById('loader').style.display = 'block';
            });

            // Oculta o loader quando o Livewire terminar de carregar
            Livewire.hook('message.processed', () => {
                document.getElementById('loader').style.display = 'none';
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            // Abrir modal ao clicar no botão "Criar Cliente"
            window.addEventListener('openClienteModal', function() {
                jQuery("#criarCliente").modal('show');
            });

            // Fechar modal e exibir notificações do Toastr
            window.addEventListener('checkToaster', function(e) {
                jQuery("#criarCliente").modal('hide');

                if (e.detail.status == "success") {
                    toastr.success(e.detail.message);
                }

                if (e.detail.status == "error") {
                    toastr.warning(e.detail.message);
                }
            });
        });
    </script>
