
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

                <div class="card-body" >
                    <div class="form-group">
                        
                        <div class="row">

                            <div class="col-xl-4 col-xs-12">
                                <label>Nome do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome do Cliente" wire:model.lazy="nomeCliente">
                                </div>
                            </div>
    
                            <div class="col-xl-4 col-xs-12">
                                <label>Número do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-ticket"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número do Cliente" wire:model.lazy="numeroCliente">
                                </div>
                            </div>
    
                            <div class="col-xl-4 col-xs-12">
                                <label>Zona</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pin2"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Zona" wire:model.lazy="zonaCliente">
                                </div>
                            </div>

                        </div>

                        <!-- PARTE DO ACCORDEON -->
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
                                                <div class="col-xl-6 col-xs-12">
                                                    <label>Telemóvel</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ti-microphone-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Telemóvel" wire:model.lazy="telemovelCliente">
                                                    </div>
                                                </div>
    
                                                <div class="col-xl-6 col-xs-12">
                                                    <label>Email</label>
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

                        <!-- FIM DO ACCORDEON -->
                                                
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
                            
                                            
                        </div>
                    </div>                  
                   
                </div>
                <div class="card-body">
                    <div id="dataTables_wrapper" class="dataTables_wrapper container" style="margin-left:0px;padding-left:0px;margin-bottom:10px;">
                        <div class="dataTables_length" id="dataTables_length">
                            <label>Mostrar
                                <select name="perPage" wire:model="perPage">
                                    <option value="10"
                                        @if ($perPage == 10) selected @endif>10</option>
                                    <option value="25"
                                        @if ($perPage == 25) selected @endif>25</option>
                                    <option value="50"
                                        @if ($perPage == 50) selected @endif>50</option>
                                    <option value="100"
                                        @if ($perPage == 100) selected @endif>100</option>
                                </select>
                                registos</label>
                        </div>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table table-responsive-lg table-bordered table-hover init-datatable" id="tabela-cliente">
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
                               
                                @foreach ($clientes as $clt )
                                    <tr data-href="{{route('visitas.detail',$clt->id)}}">
                                        <td>{{$clt->name}}</td>
                                        <td>{{$clt->no}}</td>
                                        <td>{{$clt->zone}}</td>
                                        <td>{{$clt->nif}}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-sm btn-outline-secondary" data-toggle="dropdown" aria-expanded="false">
                                                <i class="ti-settings text-light"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('visitas.detail',$clt->id)}}" class="dropdown-item">Adicionar Visita</a>
                                                {{-- <a href="{{route('visitas.new-visita',$clt->id)}}" class="dropdown-item">Agendar Visita</a> --}}
                                                <a href="javascript:void(0)" class="dropdown-item">Agendar Visita</a>
                                            </div>
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
    
</div>