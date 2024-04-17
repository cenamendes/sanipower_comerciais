<div>
    <!--  LOADING -->

    <div id="loader" style="display: none;">
      <div class="loader" role="status">
      
      </div>
  </div>

  <!-- FIM LOADING -->

  <!-- TABS  -->

  <div class="row group-buttons group-buttons d-flex justify-content-end mr-0 mb-2">
      <div class="tools">
          <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="ti-save"></i> Guardar</a>
          <a href="javascript:void(0);" class="btn btn-sm btn-secondary"> Cancelar</a>
      </div>
  </div>

  <div class="card card-tabs-pills mb-3">
      <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                  <a href="#tab4" data-toggle="tab" class="nav-link {{$tabDetail}}">Detalhes Cliente</a>
              </li>
              <li class="nav-item">
                  <a href="#tab5" data-toggle="tab" class="nav-link {{$tabProdutos}}">Produtos</a>
              </li>
              <li class="nav-item">
                  <a href="#tab6" data-toggle="tab" class="nav-link {{$tabDetalhesProposta}}">Detalhes Proposta</a>
              </li>
              <li class="nav-item">
                    <a href="#tab7" data-toggle="tab" class="nav-link ">Campanhas</a>
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
              <div class="tab-pane fade {{$tabProdutos}}" id="tab5">
  
                  <p class="card-text">
                      
                      <!-- INICIO TABELA  -->

                      <div class="row">
                          <div class="col-lg-12">
                              <div class="card mb-3">
                                  <div class="card-header uppercase">
                                      <div class="caption">
                                          <i class="ti-briefcase"></i> Grelha de Produtos
                                      </div>
                                      <div class="tools">
                                          <a href="#" class="btn btn-outline-secondary text-light"><i class="ti-pencil-alt"></i> Adicionar</a>
                                      </div>
                                  </div>
                                  <div class="card-body">
                                      <div class="table-responsive">
                                          <table class="table table-bordered table-hover">
                                              <thead class="thead-light">
                                                  <tr>
                                                      <th>Referência</th>
                                                      <th>Designação</th>
                                                      <th>Quantidade</th>
                                                      <th>Preço Unitário</th>
                                                      <th>Desconto 1</th>
                                                      <th>Desconto 2</th>
                                                      <th>Preço Total</th>
                                                      <th class="text-center">Ações</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>1</td>
                                                      <td>Mark</td>
                                                      <td>Otto</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td class="text-center"><button class="btn btn-sm btn-danger"><i class="ti-trash"></i>
                                                              Eliminar</button></td>
                                                  </tr>
                                                  <tr>
                                                      <td>1</td>
                                                      <td>Mark</td>
                                                      <td>Otto</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td>@mdo</td>
                                                      <td class="text-center"><button class="btn btn-sm btn-danger"><i class="ti-trash"></i>
                                                              Eliminar</button></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      </div>

                      <!-- FIM TABELA  -->

                  </p>
              </div>

              <div class="tab-pane fade {{$tabDetalhesProposta}}" id="tab6">
  
                  <p class="card-text">
                      
                      
                        <div class="row form-group">

                          <div class="col-xl-6 col-xs-12">

                              <div class="form-group">
                                  <label>Validade da Proposta</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text bg-carolina"><i class="ti-time text-light"></i></span>
                                      </div>
                                      <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->current_account}}" readonly>
                                  </div>
                              </div>

                          </div>
                         
                          <div class="col-xl-6 col-xs-12">

                              <div class="form-group">
                                  <label>Condições de Pagamento</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text bg-carolina"><i class="ti-money text-light"></i></span>
                                      </div>
                                      <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->balance_checks}}" readonly>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-12 col-xs-12">
  
                                <div class="form-group">
                                    <label>Observação</label>
                                    <div class="input-group">
                                        <textarea type="text" class="form-control" cols="4" rows="6" readonly style="resize: none;"></textarea>
                                    </div>
                                </div>
  
                            </div>
  
                          </div>
                      

                      

                  </p>
              </div>
              <div class="tab-pane fade" id="tab7">
    
                    <p class="card-text">
                        
                        
                        <div class="row form-group">
                            <div class="col-xl-4 col-xs-12">

                                <div class="form-group">
                                    <label>Referência</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-light-bulb text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                </div>

                            </div>
                           
                            <div class="col-xl-4 col-xs-12">

                                <div class="form-group">
                                    <label>Entrega</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-bag text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-xs-12">

                                <div class="form-group">
                                    <label>Condições de Pagamento</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-money text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover init-datatable" id="tabela-cliente">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Título</th>
                                                        <th>Número</th>
                                                        <th>Preço</th>
                                                        <th>Quantidade</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Abraçadeira</td>
                                                        <td>513130</td>
                                                        <td>€70</td>
                                                        <td>10</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary">
                                                                <i class="ti-plus"></i> Nova Ação
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Abraçadeira</td>
                                                        <td>2186325</td>
                                                        <td>€22</td>
                                                        <td>33</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary">
                                                                <i class="ti-plus"></i> Nova Ação
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Abraçadeira</td>
                                                        <td>215216</td>
                                                        <td>€59</td>
                                                        <td>20</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary">
                                                                <i class="ti-plus"></i> Nova Ação
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </p>
                </div>

          </div>
      </div>
  </div>

  <!-- FIM TABS  -->

</div>
