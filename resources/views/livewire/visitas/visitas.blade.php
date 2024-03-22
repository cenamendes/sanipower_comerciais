
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
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="ti-pin"></i> Criar Visita</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-success"><i class="ti-package"></i> Criar Encomenda</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="ti-file"></i> Criar Proposta</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="ti-eye"></i> Criar Ocorrência</a>
                            </div>
                    
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
                                        <td style="min-width: 110px;">
                                            <a href="{{route('visitas.detail',$clt->id)}}" class="btn btn-primary">
                                                <i class="ti-plus"></i>
                                            </a>
                                            {{-- <a href="{{route('visitas.new-visita',$clt->id)}}" class="btn btn-primary">
                                                <i class="ti-calendar"></i>
                                            </a> --}}
                                            <a href="javascript:void(0)" class="btn btn-primary">
                                                <i class="ti-calendar"></i>
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
    
</div>