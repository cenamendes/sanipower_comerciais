<div>
    
    <div class="card mb-3" style="height: 98%;">
        <div id="calendar"></div>
    </div>

    <span class="d-none" id="values">{{$listagemCalendario}}</span>

    <div class="modal fade" id="modalInformacao" tabindex="-1" role="dialog" aria-labelledby="modalInformacao"
    aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalProdutos">Informação do Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="scrollModal" style="overflow-y: auto;max-height:500px;">

                        <div class="row d-block text-center font-weight-bold">
                            <label class="text-center"><span id="visitaName"></span></label>
                        </div>
                       
                        
                        <label class="mt-4">Nome do Cliente</label>
                        <div class="input-group">
                           
                            <input type="text" class="form-control" placeholder="Nome do Cliente" id="clienteName" disabled>
                        </div>

                        <label class="mt-4">Data (Hora Inicial / Hora Final)</label>
                        <div class="input-group">
                            
                            <input type="text" class="form-control" placeholder="Hora Marcada" id="horaMarcada" disabled>
                        </div>

                        <label class="mt-4">Assunto</label>
                        <div class="input-group">
                            <textarea type="text" id="assuntoMarcado" class="form-control" cols="4" rows="6" disabled></textarea>
                        </div>


                    
            </div>
            <div class="modal-footer">
                <button type="button" id="cleanSelectionQuick" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



     <script>

        function startCalendarLeft()
        {
            var calendarValues = JSON.parse($('#values').text());
            
            var event = [];

            $.each(calendarValues, function(index, valores) {
                {
                    event.push({
                        title: valores.cliente,
                        start: valores.data_inicial+"T"+valores.hora_inicial,
                        end: valores.data_inicial+"T"+valores.hora_final,
                        backgroundColor: valores.tipovisita.cor,
                        assunto: valores.assunto_text,
                        dataInicial: valores.data_inicial,
                        horaInicial: valores.hora_inicial,
                        horaFinal: valores.hora_final,
                        corVisita: valores.tipovisita.cor,
                        nomeVisita: valores.tipovisita.tipo
                    })
                }
            });

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events:event,
            locale: 'pt-br',
            headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoje',
                    month: 'Mês',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Lista'
            },
            views: {
                timeGridWeek: {
                    allDayText: 'Dia'
                },
                timeGridDay: {
                    allDayText: 'Dia'
                }
            },
            //FAZER O ABRIR POP PARA VER A INFORMAÇÃO
            eventDidMount: function (info,element) {
                var scroller = info.el.closest(".fc-scroller");

                if (scroller) {
                    scroller.id = "scrollModal";
                }

    

                var eventElement = info.el.closest('.fc-daygrid-event-harness');

                    if (eventElement) {
                        eventElement.style.backgroundColor = info.backgroundColor; // Defina a cor desejada aqui
                        eventElement.style.color = "white";
                        eventElement.style.marginBottom = "5px";
                    }

                if (info.event.end - info.event.start <= 3600000) { // Se a duração for menor ou igual a 1 hora
                    info.el.classList.add('fc-short-event'); // Adiciona a classe para eventos curtos
                }
            },
            eventContent: function(arg) {
                let customDiv = document.createElement('div');
                customDiv.className = 'custom-event-content';
                    
                    let timeString = new Date(arg.event.start).toLocaleTimeString('pt-BR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) + ' - ' + new Date(arg.event.end).toLocaleTimeString('pt-BR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    var custom = customDiv.closest('.custom-event-content');
            
                    if (custom) {
                        custom.style.whiteSpace = 'normal'; // Defina a cor desejada aqui
                    }

                    customDiv.innerHTML = '<div>' + arg.event.title + '</div><div>' + timeString + '</div>';

                return { domNodes: [customDiv] };
            },
            eventClick: function(info) {

              
                $("#modalInformacao").modal();

                $('#clienteName').val(info.event.title);
                $('#horaMarcada').val(info.event.extendedProps.dataInicial+" ("+ info.event.extendedProps.horaInicial + " / "+ info.event.extendedProps.horaFinal +") ");
                $('#assuntoMarcado').val(info.event.extendedProps.assunto);
                $('#visitaName').text(info.event.extendedProps.nomeVisita);
                $('#visitaName').css("color", info.event.extendedProps.corVisita);
                
                

            }

            });

            calendar.render();
        }
        

        document.addEventListener('DOMContentLoaded', function() {
           startCalendarLeft();
        });

        document.addEventListener('restartCalendar', function() {
            startCalendarLeft();
        });


    </script>
  
</div>
