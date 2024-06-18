<div>
       @isset($listagemVisitas)
            <div class="table-responsive">
                <table class="table table-bordered table-hover init-datatable" id="tabela-cliente">
                    <thead class="thead-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Estado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listagemVisitas as $visita)
                            <tr data-href="#">
                                <td>{{ $visita->cliente }}</td>
                                <td>{{ $visita->data_inicial }} / {{ $visita->hora_inicial }}</td>
                                <td>{{ $visita->data_final }} / {{ $visita->hora_final }}</td>
                                <td>
                                    <button class="btn btn-sm btn-chili btn-round" disabled>Agendada</button>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" wire:click="endVisita({{$visita->id}})" class="btn btn-primary">
                                        <i class="ti-save"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $listagemVisitas->links() }}
            </div>
        @endisset
</div>