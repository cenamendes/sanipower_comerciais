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
            <a href="javascript:void(0);" wire:click="verEncomenda" class="btn btn-sm btn-success"><i class="ti-eye"></i> Ver Encomenda</a>
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
                    <a href="#tab6" data-toggle="tab" class="nav-link {{$tabDetalhesEncomendas}}">Detalhes Encomenda</a>
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

                        @if($specificProduct == 0)
                         <div class="row tab-encomenda-produto">
                            <div class="col">

                                <div class="row navigationLinks">
                                    
                                    <div class="col">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="ti-panel"></i> Categoria</a></li>
                                            <li class="breadcrumb-item">Familia</li>
                                            <li class="breadcrumb-item active">Sub-Familia</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="subsidebarProd overflow-y-auto" id="subItemInput1" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Sistemas</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>

                                    <br>
                                    <h5 class="family_title">Latão</h5>
                                    <br>
                                    <div class="containerCards row">
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Abraçadeira</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Acessórios Rega</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/3-C/3-C-1-1.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">PPFV</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Acessórios Express</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3 ">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Acessórios Express</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/3-C/3-C-1-1.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">PPFV</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h5 class="family_title">Válvulas</h5>
                                    <br>
                                    <div class="containerCards row">
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Abraçadeira</h5>
                                            </div>
                                        </div>
                                        <div class="col-3 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Acessórios Rega</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="subsidebarProd" id="subItemInput2" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    
                                    <h2>Água</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>

                                    <br>
                                    <h5 class="family_title">Autoclismos</h5>
                                    <br>
                                    <div class="containerCards row">
                                        <div class="col-4 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/3-C/3-C-1-1.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Abraçadeira</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">Acessórios Rega</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 col-xl-2 col-md-3">
                                            <div class="card-decorate">
                                                <div class="img-card-cicle">
                                                    <img src="https://storage.sanipower.pt/storage/produtos/3-C/3-C-1-1.jpg" class="card-img-top" alt="...">
                                                </div>
                                                <h5 class="title-description-family">PPFV</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput3" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Conforto</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput4" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Solar</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput5" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>ArCondicionado</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput6" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Ventilação</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput7" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Piscinas</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="subsidebarProd" id="subItemInput8" style="display: none;">
                                    <a href="javascript:void(0)" class="buttonGoback"><i class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                    <h2>Marcas</h2>
                                    <div class="d-flex inputSeachfamily">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control " placeholder="Search">
                                    </div>
                                </div>
                                <div class="sidebarProd" id="sidebarProd">
                                    <label for="checkbox" style="width: 100%;">
                                        <div class="input-group" id="checkboxSidbar">
                                            <label><i class="ti-menu"></i></label>
                                            <p>PRODUTOS</p>
                                        </div>
                                    </label>
                                    
                                    <div class="input-group d-flex justify-content-between" id="input1">
                                        <p>Sistemas</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input2">
                                        <p>Água</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input3">
                                        <p>Conforto</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input4">
                                        <p>Solar</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input5">
                                        <p>ArCondicionado</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input6">
                                        <p>Ventilação</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input7">
                                        <p>Piscinas</p>
                                        <label>></label>
                                    </div>
                                    <div class="input-group d-flex justify-content-between" id="input8">
                                        <p>Marcas</p>
                                        <label>></label>
                                    </div>
                                </div> 
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <div class="input-group" id="checkboxSidbar">
                                            <input id="checkbox" type="checkbox">
                                            <label class="toggle" for="checkbox">
                                                <div id="bar1" class="bars"></div>
                                                <div id="bar2" class="bars"></div>
                                                <div id="bar3" class="bars"></div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-8 col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-search text-light"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="row">                                   

                                    <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                                        <div class="card card-decoration card-outline-primary border border-2" wire:click="openDetailProduto(1)">
                                            <div class="mb-1">
                                                <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                <div class="body-decoration">
                                                    <h5 class="title-description">Abraçadeira Quadrada c/Parafuso</h5>
                                                </div> 
                                            </div>
                                            <div class="card-body container-buttons">
                                                <button class="btn btn-sm btn-primary" wire:click="adicionarProduto(1)"><i class="ti-shopping-cart"></i><span> Comprar</span></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                                        <div class="card card-decoration card-outline-primary border border-2" wire:click="openDetailProduto(1)">
                                            <div class="mb-1">
                                                <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                <div class="body-decoration">
                                                    <h5 class="title-description">Abraçadeira Quadrada c/Parafuso</h5>
                                                </div> 
                                            </div>
                                            <div class="card-body container-buttons">
                                                <button class="btn btn-sm btn-primary" wire:click="adicionarProduto(1)"><i class="ti-shopping-cart"></i><span> Comprar</span></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                                        <div class="card card-decoration card-outline-primary border border-2" wire:click="openDetailProduto(1)">
                                            <div class="mb-1">
                                                <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                <div class="body-decoration">
                                                    <h5 class="title-description">Abraçadeira Quadrada c/Parafuso</h5>
                                                </div> 
                                            </div>
                                            <div class="card-body container-buttons">
                                                <button class="btn btn-sm btn-primary" wire:click="adicionarProduto(1)"><i class="ti-shopping-cart"></i><span> Comprar</span></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                                        <div class="card card-decoration card-outline-primary border border-2" wire:click="openDetailProduto(1)">
                                            <div class="mb-1">
                                                <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                <div class="body-decoration">
                                                    <h5 class="title-description">Abraçadeira Quadrada c/Parafuso</h5>
                                                </div> 
                                            </div>
                                            <div class="card-body container-buttons">
                                                <button class="btn btn-sm btn-primary" wire:click="adicionarProduto(1)"><i class="ti-shopping-cart"></i><span> Comprar</span></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                                        <div class="card card-decoration card-outline-primary border border-2" wire:click="openDetailProduto(1)">
                                            <div class="mb-1">
                                                <img src="https://storage.sanipower.pt/storage/produtos/2/2-1-5.jpg" class="card-img-top" alt="...">
                                                <div class="body-decoration">
                                                    <h5 class="title-description">Abraçadeira Quadrada c/Parafuso</h5>
                                                </div> 
                                            </div>
                                            <div class="card-body container-buttons">
                                                <button class="btn btn-sm btn-primary" wire:click="adicionarProduto(1)"><i class="ti-shopping-cart"></i><span> Comprar</span></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                    
                        @else
                            <div class="row mb-2 border-bottom">
                                <a href="javascript:void(0)" wire:click="recuarLista(5)" class="mb-3 ml-2"><i class="ti-angle-left"></i> Atrás</a>
                            </div>
                            
                            <div class="row container-detalhes-produto">

                                <div class="col-4 d-none d-lg-block">
                                    <img src="https://storage.sanipower.pt/storage/produtos/3-C/3-C-1-1.jpg" width=100%>
                                </div>
                                <div class="col-lg-8 col-12">

                                    <div class="row">
                                        <div class="col-xl-12 mb-2">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <img src="https://digital.sanipower.pt/assets/marcas/vissen.jpg" width=50>
                                                </div>
                                                <div class="col-xs-9 d-flex align-middle pl-2" style="align-items:center;">
                                                    <h3>VISSEN (NOME DO PRODUTO)</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Referência</th>
                                                        <th>Modelo</th>
                                                        <th>PVP unitário</th>
                                                        <th>Desconto</th>
                                                        <th>Preço unitário</th>
                                                        <th>Quantidade mínima</th>
                                                        <th>Stock</th>
                                                        <th>Quantidade a encomendar</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>COP10700016</td>
                                                        <td>Ø16</td>
                                                        <td>1,450 €</td>
                                                        <td>50 %</td>
                                                        <td>0,725 €</td>
                                                        <td></td>
                                                        <td style="text-align:center;font-size:large;"><i class="ti-check text-lg text-forest"></i></td>
                                                        <td><input type="number" id="qtdEnc" class="form-control"></td>
                                                        <td class="text-center">
                                                            <a href="javascript:;" class="btn btn-sm btn-outline-secondary" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti-settings text-light"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <button class="btn btn-sm dropdown-item">Consultar Caixa</button>
                                                                <button class="btn btn-sm dropdown-item">Adicionar Visita</button>
                                                                <button class="btn btn-sm dropdown-item">Justificar Quantidade</button>
                                                                <button class="btn btn-sm dropdown-item" >Adicionar Encomenda</button>
                                                            </div>
                                                        </td>
                                                    </tr>
            
                                                    <tr>
                                                        <td>COP10700020</td>
                                                        <td>Ø20x3.4</td>
                                                        <td>1,851 €</td>
                                                        <td>50 %</td>
                                                        <td>0,926 €</td>
                                                        <td></td>
                                                        <td style="text-align:center;font-size:large;"><i class="ti-close text-lg text-chili"></i></td>
                                                        <td><input type="number" id="qtdEnc" class="form-control"></td>
                                                        <td class="text-center">
                                                            <a href="javascript:;" class="btn btn-sm btn-outline-secondary" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti-settings text-light"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <button class="btn btn-sm dropdown-item">Consultar Caixa</button>
                                                                <button class="btn btn-sm dropdown-item">Adicionar Visita</button>
                                                                <button class="btn btn-sm dropdown-item">Justificar Quantidade</button>
                                                                <button class="btn btn-sm dropdown-item" >Adicionar Encomenda</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>   
                                        <div class="container-buttons-produtos">
                                            <div>
                                                <button class="btn btn-md btn-primary"><i class="ti-file"></i> Ficha do Produto</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-md btn-primary"><i class="ti-close"></i> Limpar Seleção</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-md btn-primary"><i class="ti-shopping-cart"></i> Adicionar Todos</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-md btn-primary"><i class="ti-info"></i> Descrição Produto</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-md btn-primary"><i class="ti-file"></i> Manuais Certificados</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    
                </div>

                <div class="tab-pane fade {{$tabDetalhesEncomendas}}" id="tab6">
    
                    <p class="card-text">
                        
                        
                        <div class="row form-group">
                            <div class="col-xl-4 col-xs-12">

                                <div class="form-group">
                                    <label>Referência</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-carolina"><i class="ti-light-bulb text-light"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->open_occurrences}}" readonly>
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
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->balance_checks}}" readonly>
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
                                        <input type="text" class="form-control" value="{{$detalhesCliente->customers[0]->balance_checks}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-xl-12 col-xs-12">

                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea type="text" class="form-control" cols="4" rows="6" style="resize: none;"></textarea>
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


    <!-- MODALS -->

     <!-- Modal adicionar compra rapida -->
     <div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="modalProdutos"
     aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalProdutos"><img src="https://digital.sanipower.pt/assets/marcas/vissen.jpg" width=50> (NOME DO PRODUTO PHC)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Referência</th>
                                            <th>Modelo</th>
                                            <th>PVP unitário</th>
                                            <th>Desconto</th>
                                            <th>Preço unitário</th>
                                            <th>Quantidade mínima</th>
                                            <th>Stock</th>
                                            <th>Quantidade a encomendar</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>COP10700016</td>
                                            <td>Ø16</td>
                                            <td>1,450 €</td>
                                            <td>50 %</td>
                                            <td>0,725 €</td>
                                            <td></td>
                                            <td style="text-align:center;font-size:large;"><i class="ti-check text-lg text-forest"></i></td>
                                            <td><input type="number" id="qtdEnc" class="form-control"></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary"><i class="ti-plus"></i></button>
                                                <button class="btn btn-sm btn-warning"><i class="ti-comment"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>COP10700020</td>
                                            <td>Ø20x3.4</td>
                                            <td>1,851 €</td>
                                            <td>50 %</td>
                                            <td>0,926 €</td>
                                            <td></td>
                                            <td style="text-align:center;font-size:large;"><i class="ti-close text-lg text-chili"></i></td>
                                            <td><input type="number" id="qtdEnc" class="form-control"></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary"><i class="ti-plus"></i></button>
                                                <button class="btn btn-sm btn-warning"><i class="ti-comment"></i></button>
                                            </td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Limpar seleção</button>
                    <button type="button" class="btn btn-outline-primary">Adicionar todos</button>
                </div>
            </div>
        </div>
    </div>

    <!----->

    <!-- Modal ver encomenda -->
    <div class="modal fade" id="modalEncomenda" tabindex="-1" role="dialog" aria-labelledby="modalEncomenda"
    aria-hidden="true">
       <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title text-primary" id="modalEncomenda"><i class="ti-archive"></i> Encomenda atual</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="card mb-3">
                       <div class="card-body">
                           <div class="table-responsive">
                               <table class="table table-bordered table-hover">
                                   <thead class="thead-light">
                                       <tr>
                                           <th>Referência</th>
                                           <th>Designação</th>
                                           <th>Quantidade</th>
                                           <th>Preço unitário</th>
                                           <th>Desconto 1</th>
                                           <th>Desconto 2</th>
                                           <th>Preço Total</th>
                                           <th class="text-center">Ações</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td>COP10700016</td>
                                           <td>Ø16</td>
                                           <td>1,450 €</td>
                                           <td>50 %</td>
                                           <td>0,725 €</td>
                                           <td></td>
                                           <td>22</td>
                                           <td class="text-center">
                                               <button class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                                           </td>
                                       </tr>

                                       <tr>
                                        <td>COP10700020</td>
                                        <td>Ø20x3.4</td>
                                        <td>1,851 €</td>
                                        <td>50 %</td>
                                        <td>0,926 €</td>
                                        <td></td>
                                        <td>22</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                                        </td>
                                          
                                       </tr>
                                   
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Limpar seleção</button>
                   <button type="button" class="btn btn-outline-primary">Concluir Encomenda</button>
               </div>
           </div>
       </div>
   </div>

   <!----->
    

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    const checkbox = document.getElementById('checkbox');
    
    const sidebar = document.getElementById('sidebarProd');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            sidebar.classList.add('open');
        } else {
            sidebar.classList.remove('open');
        }
    });


    const inputGroups = document.querySelectorAll('.input-group');
        let currentSubItem = null;

        inputGroups.forEach(function(inputGroup) {
            inputGroup.addEventListener('click', function() {
                const id = this.id;
                const subItemId = 'subItemInput' + id.slice(-1);
                const subItem = document.getElementById(subItemId);

                if (currentSubItem === subItem) {
                    subItem.style.display = 'none';
                    currentSubItem = null;
                } else {
                    document.querySelectorAll('.subsidebarProd').forEach(function(item) {
                        item.style.display = 'none';
                    });

                    subItem.style.display = 'block';
                    currentSubItem = subItem;
                }
            });
        });
        jQuery('body').on('click', '.buttonGoback', function() {
            document.querySelectorAll('.subsidebarProd').forEach(function(item) {
                item.style.display = 'none';
            });
        });

</script>

