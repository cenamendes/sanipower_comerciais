<div>
    <!--  LOADING -->

    <div class="loader" wire:loading.delay></div>

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

                            <div class="col-xl-4 col-xs-12">
                                <label>Nome do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome do Cliente">
                                </div>
                            </div>
    
                            <div class="col-xl-4 col-xs-12">
                                <label>Número do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-ticket"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número do Cliente">
                                </div>
                            </div>
    
                            <div class="col-xl-4 col-xs-12">
                                <label>Zona</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pin2"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Zona">
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover init-datatable" id="">
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
                                    <tr data-href="{{route('clientes.detail',$clt->id)}}">
                                        <td>{{$clt->name}}</td>
                                        <td>{{$clt->id}}</td>
                                        <td>{{$clt->email}}</td>
                                        <td>{{$clt->name}}</td>
                                        <td>
                                            <a href="{{route('clientes.detail',$clt->id)}}" class="btn btn-primary">
                                                <i class="ti-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <!-- FIM TABELA  -->
</div>
