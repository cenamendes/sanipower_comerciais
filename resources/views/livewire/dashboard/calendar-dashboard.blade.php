<div>
    <style>

    </style>

    <div class="card mb-3" style="height: 98%;">
        <div id="calendar"></div>
    </div>

      <span class="d-none" id="values">{{$listagemCalendario}}</span>
     <script>

        document.addEventListener('DOMContentLoaded', function() {
            
            var calendarValues = JSON.parse($('#values').text());
            
            var event = [];

            $.each(calendarValues, function(index, valores) {
                {
                    event.push({
                        title: valores.cliente,
                        start: valores.data_inicial+"T"+valores.hora_inicial,
                        end: valores.data_inicial+"T"+valores.hora_final,
                        backgroundColor: valores.tipovisita.cor
                        // idTask: idTask,
                        // descricao: descricao
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

                console.log(info);

                var eventElement = info.el.closest('.fc-daygrid-event-harness');

                    if (eventElement) {
                        eventElement.style.backgroundColor = info.backgroundColor; // Defina a cor desejada aqui
                        eventElement.style.color = "white";
                        eventElement.style.marginBottom = "5px";
                    }
            }

            });

            calendar.render();
        });


    </script>
  
</div>
