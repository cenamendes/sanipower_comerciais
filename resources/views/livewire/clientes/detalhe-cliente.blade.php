<div>
      <!--  LOADING -->

      <div id="loader" style="display: none;">
        <div class="loader" role="status">
        
        </div>
    </div>

    <!-- FIM LOADING -->

    <!-- TABS  -->

    <div class="row d-flex justify-content-end mr-0 mb-2">
        <div class="tools">
            <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="ti-pin"></i> Criar Visita</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-success"><i class="ti-package"></i> Criar Encomenda</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="ti-file"></i> Criar Proposta</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-warning"><i class="ti-eye"></i> Criar Ocorrência</a>
        </div>
    </div>

    <div class="card card-tabs-pills mb-3">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="#tab4" data-toggle="tab" class="nav-link {{$tabDetail}}">Detalhes Cliente</a>
                </li>
                <li class="nav-item">
                    <a href="#tab5" data-toggle="tab" class="nav-link {{$tabAnalysis}}">Análises Gerais</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade {{$tabDetail}}" id="tab4">
                    <h4 class="card-title">{{$detalhesCliente->customers[0]->name}}</h4>
                    <p class="card-text">
                       
                        <!--  INICIO DOS DETALHES   -->

                        <div class="row form-group">
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Nome do Cliente</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-user text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->name}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Nº do Cliente</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-info-alt text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->no}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Nº de Contribuinte</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-marker text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->nif}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Morada</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-location-arrow text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->address}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Localidade</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-location-arrow text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->city}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Código Postal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-location-arrow text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->zipcode}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Zona do Cliente</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-pin text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->zone}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Contactos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-email text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->phone}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">
                                
                                <div class="form-group">
                                    <label>Nº Propostas em aberto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-comment text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->open_proposals}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Nº Ocorrências em aberto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-light-bulb text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->open_occurrences}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Saldo em Aberto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-money text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->current_account}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Cheques em carteira</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-bag text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->balance_checks}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Pontos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-stats-up text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->balance_points}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4">

                                <div class="form-group">
                                    <label>Condições de pagamento</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-credit-card text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->payment_conditions}}" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <!--  FIM DETALHES   -->
                    </p>
                </div>
                <div class="tab-pane fade {{$tabAnalysis}}" id="tab5">
    
                    <p class="card-text">
                        
                        <!-- INICIO TABELA  -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-3">
                                    <div class="card-header d-block">
                                        <div class="row">
                                            <div class="col-xl-8 col-xs-12">
                                                <div class="caption uppercase">
                                                    <i class="ti-stats-up"></i> Análises
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
                                      
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="tabela-cliente2">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Encomenda</th>
                                                        <th>Total</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @foreach ($analisesCliente as $clt )
                                                        <tr>
                                                            <td>{{date('Y-m-d',strtotime($clt->date))}}</td>
                                                            <td>{{$clt->order}}</td>
                                                            <td>{{$clt->total}}</td>
                                                            <td>{{$clt->status}}</td>
                                                        </tr>
                                                    @endforeach
                                        
                                                </tbody>
                                            </table>
                                        </div>  
                                        {{ $analisesCliente->links() }}             
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <!-- FIM TABELA  -->

                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FIM TABS  -->

</div>
