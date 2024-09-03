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

        .visita-tipo.selected {
            font-weight: bold;
        }
    </style>
    <h5>Próximas Visitas</h5>

    <div id="visita-tipos"
        style="display: flex; flex-wrap: wrap; flex-direction: row; justify-content: space-evenly; padding-top:1rem;">
        @foreach ($tiposvisitas as $visitatipos)
            <p class="card-text visita-tipo" data-cor="{{ $visitatipos->cor }}" style="cursor: pointer;">
                 {{ $visitatipos->tipo }}
            </p>
        @endforeach
    </div>

    <hr style="width: 90%; margin:0.3rem 0; margin-left:0.8rem">

    <div class="profile-calendar" style="max-height:66vh; overflow-y: auto;width:100%;">
        @foreach($visitas->groupBy(function($item) { return $item->data_inicial; }) as $data => $groupedVisitas)
        <div class="visita-group">
            <h6 style="padding-top: 0.8rem; font-size: 1.1rem;">Dia: {{ $data }}</h6>
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
                    @foreach($groupedVisitas as $visita)
                    <tr class="visita-row" data-cor="{{ $visita->tipovisita->cor }}" data-href="{{route('visitas.info',$visita->id)}}">
                        <td style="cursor: default;">
                            {{ $visita->tipovisita->nome }}
                            @if($visita->finalizado == 0)
                                <i class="fa fa-circle" style="color:blue"></i>
                            @elseif($visita->finalizado == 1)
                                <i class="fa fa-circle" style="color:green"></i>
                            @else
                                <i class="fa fa-circle" style="color:#e6e600"></i>
                            @endif
                           
                        </td>
                        <td style="cursor: default;">{{ $visita->cliente }}</td>
                        <td style="cursor: default;">{{ $visita->data_inicial }} {{ $visita->hora_inicial }}</td>
                        <td style="cursor: default;">{{ $visita->data_final }} {{ $visita->hora_final }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>

    <script>

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


        document.querySelectorAll('.visita-tipo').forEach(function(element) {
            element.addEventListener('click', function() {
                var cor = this.getAttribute('data-cor');
                var isSelected = this.classList.contains('selected');

                document.querySelectorAll('.visita-tipo').forEach(function(el) {
                    el.classList.remove('selected');
                });

                if (!isSelected) {
                    this.classList.add('selected');
                }

                document.querySelectorAll('.visita-group').forEach(function(group) {
                    var hasVisibleRows = false;
                    group.querySelectorAll('.visita-row').forEach(function(row) {
                        if (!isSelected && row.getAttribute('data-cor') === cor) {
                            row.style.display = '';
                            hasVisibleRows = true;
                        } else if (isSelected) {
                            row.style.display = '';
                            hasVisibleRows = true;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    if (hasVisibleRows) {
                        group.style.display = '';
                    } else {
                        group.style.display = 'none';
                    }
                });

                if (isSelected) {
                    document.querySelectorAll('.visita-group').forEach(function(group) {
                        group.style.display = '';
                        group.querySelectorAll('.visita-row').forEach(function(row) {
                            row.style.display = '';
                        });
                    });
                }
            });
        });
    </script>

</div>
