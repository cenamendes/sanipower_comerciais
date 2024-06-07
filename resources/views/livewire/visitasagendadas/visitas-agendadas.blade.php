<div>
    <style>
.profile-calendar::-webkit-scrollbar {
    width: 6px;
}

.profile-calendar::-webkit-scrollbar-thumb {
    background: #37448e;
}

.profile-calendar::-webkit-scrollbar-track {
    background: #f1f1f1;
}
    </style>
    <h5>Próximas Visitas</h5>

    <div style="display: flex; flex-wrap: wrap; flex-direction: row; justify-content: space-evenly; padding-top:1rem;">
        @foreach($tiposvisitas as $visitatipos)
        <p class="card-text"><i class="fa fa-circle" style="color:{{ $visitatipos->cor }}"></i> {{ $visitatipos->tipo }}</p>
        @endforeach
    </div>
    <hr style="width: 90%; margin:0.3rem 0; margin-left:0.8rem">
    <div class="profile-calendar" style="height: 700px; overflow-y: auto;">
        @foreach($visitas->groupBy(function($item) { return $item->data_inicial; }) as $data => $groupedVisitas)
        <h6 style="padding-top:0.8rem; font-size:1.1rem;">Dia: {{ $data }}</h6>
        <table class="table table-bordered table-hover table-sm" style="text-align: center;">
            <thead class="thead-light">
                <tr>
                    <th scope="col" style="font-size: 0.85rem; padding: 0.8rem 0.3rem; cursor: default;">Tipo</th>
                    <th scope="col" style="font-size: 0.85rem; padding: 0.8rem 0.3rem; cursor: default;">Cliente</th>
                    <th scope="col" style="font-size: 0.85rem; padding: 0.8rem 0.3rem; cursor: default;">Data Inicial</th>
                    <th scope="col" style="font-size: 0.85rem; padding: 0.8rem 0.3rem; cursor: default;">Data Final</th>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        @foreach($groupedVisitas as $visita)
                        <tr>
                            <td style="cursor: default;">
                                {{ $visita->tipovisita->nome }}
                                <i class="fa fa-circle" style="color:{{ $visita->tipovisita->cor }}"></i>
                            </td>
                            <td style="cursor: default;">{{ $visita->cliente }}</td>
                            <td style="cursor: default;">{{ $visita->data_inicial }} {{ $visita->hora_inicial }}</td>
                            <td style="cursor: default;">{{ $visita->data_final }} {{ $visita->hora_final }}</td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
