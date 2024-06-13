@extends('main')

@section('body')
    <style>
        #calendar {
            padding: 10px;
        }

        .scrollbox-md {
   overflow-y: auto;
}

.card-body {
   flex-grow: 1;
}

#filterOptions {
   position: absolute;
   background-color: white;
   z-index: 10;
   width: 100%;
   top: 8rem;
   box-shadow: 0px 8px 8px #e8e8e8;
}


.fc .fc-button-primary:not(:disabled).fc-button-active, .fc .fc-button-primary:not(:disabled):active {
    background-color: #0c7294!important;
    border-color: #0c7294!important;
    color: white!important;
    border: none;
}

.fc .fc-button-primary {
    background-color: #1791ba!important;
    border-color: #1791ba!important;
    color: white!important;
}
.fc .fc-button-primary:not(:disabled):active:focus {
    box-shadow: none;
}

    </style>

            <!-- BOF Breadcrumb -->
            <div class="row navigationLinks">
                <div class="col">
                    <ol class="breadcrumb" style="padding-left: 25px;">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="ti-home"></i> Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <!-- EOF Breadcrumb -->

 <!-- EOF Breadcrumb -->

     <!-- BOF MAIN-BODY -->
     {{-- <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="icon-left text-secondary"><i class="ti-bar-chart"></i></div>
                            <div class="number-right text-right">
                                <h6 class="bold text-secondary">Objetivo mensal</h6>
                                <h3 class="card-title text-warning bold">74,502€</h3>
                            </div>
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress-text text-secondary">
                                <span class="float-left"><small>0€</small></span>
                                <span class="float-right"><small>100,000€</small></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="icon-left text-secondary"><i class="ti-receipt"></i></div>
                            <div class="number-right text-right">
                                <h6 class="bold text-secondary">Encomendas Mensais</h6>
                                <h3 class="card-title text-primary bold">9,432</h3>
                            </div>
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress-text text-secondary">
                                <span class="float-left"><small>Total Encomendas Mensais</small></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="icon-left text-secondary"><i class="ti-wallet"></i></div>
                            <div class="number-right text-right">
                                <h6 class="bold text-secondary">Gastos Mensais</h6>
                                <h3 class="card-title text-bubblegum bold">2,942€</h3>
                            </div>
                            <div class="progress progress-bar-sm">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-bubblegum" role="progressbar" style="width: 30%" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress-text text-secondary">
                                <span class="float-left"><small>0%</small></span>
                                <span class="float-right"><small>100%</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

     <!-- Year Comparison Chart -->
     {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body" id="year-comparison-chart"></div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <!-- Employees Sales -->
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    
                    @livewire('dashboard.calendar-dashboard')

                </div>

                <!-- My Tasks -->
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="card mb-3" style="min-height: 98%;">
                        <div class="card-header">
                            <div class="caption">
                                <i class="ti-pencil-alt"></i> Listas Tarefas
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Add New Task"><i
                                        class="ti-plus"></i> Adicionar Tarefa</a>
                                {{-- <a href="javascript:;" class="btn btn-sm btn-outline-secondary" data-toggle="dropdown" aria-expanded="false">
                                           <i class="ti-settings"></i> Definições <i class="ti-arrow-circle-down"></i>
                                       </a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                           <a href="javascript:;" class="dropdown-item">Ações</a>
                                           <a href="javascript:;" class="dropdown-item">Outras Ações</a>
                                           <div class="dropdown-divider"></div>
                                           <a href="javascript:;" class="dropdown-item">Mesma Definição</a>
                                       </div> --}}
                            </div>
                        </div>
                        <!-- Filter Section -->
                        <div class="col-md-12" style="padding-top: 0.5rem; display: flex; justify-content: center;">
                           <div style="width: 100%; padding-top: 0.5rem; border:0.8px solid #b3b3b3; padding:0.3rem; display:flex;">
                           <button class="btn" id="toggleFilters" style="width: 100%; color:#1791ba;">+ Filtros</button>
                           </div>
                       </div>
                       <div id="filterOptions" style="display: none; position: absolute; background-color: white; z-index: 10; width: 100%; top: 8rem; box-shadow: 0px 8px 8px #e8e8e8;">
                           <div class="card-body">
                               <!-- Add your filter options here -->
                               <div class="form-group">
                                   <label for="filterByStatus">Status</label>
                                   <select class="form-control" id="filterByStatus">
                                       <option value="all">Todos</option>
                                       <option value="scheduled">Agendadas</option>
                                       <option value="completed">Realizadas</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label for="filterByClient">Cliente</label>
                                   <input type="text" class="form-control" id="filterByClient" placeholder="Nome do cliente">
                               </div>
                               <div class="form-group">
                                   <label for="filterByDate">Data</label>
                                   <input type="date" class="form-control" id="filterByDate">
                               </div>
                               <button class="btn btn-primary">Aplicar Filtros</button>
                           </div>
                       </div>
                        <div class="card-body">
                            <div class="row py-3">
                                <div class="col-md-6 col-6 d-flex flex-column align-items-center">
                                    <h2 class="text-warning bold">10</h2>
                                    Agendadas
                                </div>
                                <div class="col-md-6 col-6 d-flex flex-column align-items-center">
                                    <h2 class="text-secondary bold">5</h2>
                                    Realizadas
                                </div>
                            </div>

                            <div class="row">
                               <div class="col-md-12 scrollbox-md" data-simplebar  style="height: 500px;">
                                   <ul class="list-group list-group-flush">
                                       <li class="list-group-item">
                                           <div class="d-flex align-items-baseline">
                                               <div class="pl-4">
                                                   <h4 style="font-size: 1.1rem; font-weight:900;">Cliente</h4>
                                                   <h4 style="font-size: 1rem; font-weight:400;">Assunto</h4>
                                                   <p>Descrição</p>
                                               </div>
                                               <div class="ml-auto text-right">
                                                   <div class="btn-group btn-group-sm">
                                                       <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                       <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="d-flex align-items-baseline">
                                               <div class="pl-4">
                                                   <h4 style="font-size: 1.1rem; font-weight:900;">Cliente</h4>
                                                   <h4 style="font-size: 1rem; font-weight:400;">Assunto</h4>
                                                   <p>Descrição</p>
                                               </div>
                                               <div class="ml-auto text-right">
                                                   <div class="btn-group btn-group-sm">
                                                       <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                       <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="d-flex align-items-baseline">
                                               <div class="pl-4">
                                                   <h4 style="font-size: 1.1rem; font-weight:900;">Cliente</h4>
                                                   <h4 style="font-size: 1rem; font-weight:400;">Assunto</h4>
                                                   <p>Descrição</p>
                                               </div>
                                               <div class="ml-auto text-right">
                                                   <div class="btn-group btn-group-sm">
                                                       <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                       <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="d-flex align-items-baseline">
                                               <div class="pl-4">
                                                   <h4 style="font-size: 1.1rem; font-weight:900;">Cliente</h4>
                                                   <h4 style="font-size: 1rem; font-weight:400;">Assunto</h4>
                                                   <p>Descrição</p>
                                               </div>
                                               <div class="ml-auto text-right">
                                                   <div class="btn-group btn-group-sm">
                                                       <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                       <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                       <li class="list-group-item">
                                           <div class="d-flex align-items-baseline">
                                               <div class="pl-4">
                                                   <h4 style="font-size: 1.1rem; font-weight:900;">Cliente</h4>
                                                   <h4 style="font-size: 1rem; font-weight:400;">Assunto</h4>
                                                   <p>Descrição</p>
                                               </div>
                                               <div class="ml-auto text-right">
                                                   <div class="btn-group btn-group-sm">
                                                       <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                       <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                        {{-- <li class="list-group-item">
                                                   <div class="d-flex align-items-baseline">
                                                       <div class="custom-checkbox custom-control">
                                                           <input type="checkbox" class="custom-control-input" id="checkbox2" name="checkbox2">
                                                           <label class="custom-control-label" for="checkbox2">&nbsp;</label>
                                                       </div>
                                                       <div class="pl-4">
                                                           <strong>Visita 2</i></strong><br>Visita Cliente
                                                       </div>
                                                       <div class="ml-auto text-right">
                                                           <div class="btn-group btn-group-sm">
                                                               <a href="javascript:;" class="btn btn-sm btn-success"><i class="ti-check"></i></a>
                                                               <a href="javascript:;" class="btn btn-sm btn-secondary"><i class="ti-trash"></i></a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Articles -->


            <div class="row">
                <!-- Product Sales Chart -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body" id="product-sales-chart"></div>
                    </div>
                </div>

                <!-- Expenses Chart -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body" id="expenses-chart"></div>
                    </div>
                </div>
            </div>
            <!-- EOF MAIN-BODY -->


@endsection

@push('scripts_footer')
    <script src="{{asset('assets/scripts/pages/dashboard1.js')}}"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>

    <script>
        document.getElementById('toggleFilters').addEventListener('click', function() {
            var filterOptions = document.getElementById('filterOptions');
            if (filterOptions.style.display === 'none' || filterOptions.style.display === '') {
                filterOptions.style.display = 'block';
            } else {
                filterOptions.style.display = 'none';
            }
        });

    </script>
    

@endpush


