<div>

    <style>
        @media (max-width: 1100px) {
            .btn:not(:disabled):not(.disabled) {
                cursor: pointer;
                font-size: 0.9rem;
                height: auto;
                padding: 0.3rem 0.6rem;
                margin-top: 0.6rem;
            }
        }

        @media (max-width: 680px) {
            .btn:not(:disabled):not(.disabled) {
                cursor: pointer;
                font-size: 0.8rem;
                height: auto;
                padding: 0.3rem 0.5rem;
                margin-top: 0.6rem;
            }

            .col-lg-12 {
                padding-right: 0;
                padding-left: 8px;
            }

            .card-body {

                padding: 0.35rem;
            }

            .main {
                padding-left: 0.3rem !important;
            }

            .table td {
                padding: 0.5rem;
                font-size: 0.8rem;
            }

            .table .thead-light th {
                font-size: 0.9rem;
                padding: 0.5rem;
            }

        }
    </style>
    <!--  LOADING -->

    <div id="loader" style="display: none;">
        <div class="loader" role="status">

        </div>
    </div>

    <!-- FIM LOADING -->


    <!-- INICIO TABELA  -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-xl-8 col-xs-12">
                            <div class="caption uppercase">
                                <i class="ti-stats-up"></i> Visitas
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <div id="dataTables_wrapper" class="dataTables_wrapper container" style="margin-left:0px;padding-left:0px;margin-bottom:10px;">
                        <div class="left">
                            <label>
                                Mostrar
                                <select name="perPage" wire:model="perPage">
                                    <option value="10" @if ($perPage==10) selected @endif>10</option>
                                    <option value="25" @if ($perPage==25) selected @endif>25</option>
                                    <option value="50" @if ($perPage==50) selected @endif>50</option>
                                    <option value="100" @if ($perPage==100) selected @endif>100
                                    </option>
                                </select>
                                registos
                            </label>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tabela-cliente2">
                            <thead class="thead-light">
                                <tr>
                                    <th>Assunto</th>
                                    <th>Relatório</th>
                                    <th>Tipo de visita</th>
                                    <th>Pendente visita</th>
                                    <th>Comentario Encomenda</th>
                                    <th>Comentario Proposta</th>
                                    <th>Comentario Financeiro</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailsVisitasCliente as $details)
                                    <tr>
                                        <td>{{ $details->subject }}</td>
                                        <td>{{ $details->report }}</td>
                                        <td>{{ $details->typeof_visit }}</td>
                                        <td>{{ $details->pending_next_visit }}</td>
                                        <td>{{ $details->comment_orders }}</td>
                                        <td>{{ $details->comment_budget }}</td>
                                        <td>{{ $details->comment_financial }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $detailsVisitasCliente->links() }}
                </div>
            </div>
        </div>

    </div>

    <!-- FIM TABELA  -->


    <!-- MODALS -->


    

</div>