
 <div>
 <style>
     @media (max-width: 540px) {
        .container-buttons{
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }
        .container-buttons .btn-primary{
            font-size: 0.75125rem;
        }
        .title-description{
            font-size: 10px;
        }
    }

</style>
    <!--  LOADING -->
    @if ($showLoaderPrincipal == true)
        <div id="loader" style="display: none;">
            <div class="loader" role="status">

            </div>
        </div>
    @endif

    <!-- FIM LOADING -->

    <!-- TABS  -->

    {{-- <div class="row group-buttons group-buttons d-flex justify-content-end mr-0 mb-2">
        <div class="tools">
            <a href="javascript:void(0);" wire:click="verEncomenda" class="btn btn-sm btn-success"><i class="ti-eye"></i>
                Ver Encomenda</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="ti-save"></i> Guardar</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-secondary"> Cancelar</a>
        </div>
    </div> --}}

    <div class="card card-tabs-pills mb-3">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="#tab4" data-toggle="tab" class="nav-link {{ $tabDetail }}">Detalhes Cliente</a>
                </li>
                <li class="nav-item">
                    <a href="#tab5" data-toggle="tab" class="nav-link {{ $tabProdutos }}">Produtos</a>
                </li>
                <li class="nav-item">
                    <a href="#tab6" data-toggle="tab" class="nav-link {{ $tabDetalhesEncomendas }}">Artigos</a>
                </li>
            </ul>

            <div class="teste" style="padding-right:35px;">
                <div class="row group-buttons group-buttons d-flex justify-content-end mr-0 mb-2">
                    <div class="tools">
                        <a href="javascript:void(0);" wire:click="verEncomenda" class="btn btn-sm btn-success"><i
                                class="ti-eye"></i>
                            Ver Encomenda</a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="ti-save"></i> Guardar</a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-secondary"> Cancelar</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body" id="scrollModalBody" style="overflow-y:auto;max-height:64vh;padding-right: 0;">
            <div class="tab-content">

                <div class="tab-pane fade {{ $tabDetail }}" id="tab4">
                    <h4 class="card-title">{{ $detalhesCliente->customers[0]->name }}</h4>
                    <p class="card-text">

                        <!--  INICIO DOS DETALHES   -->

                    <div class="row form-group">
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Nome do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-user text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->name }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Nº do Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-info-alt text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->no }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Nº de Contribuinte</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-marker text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->nif }}" readonly>
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
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-location-arrow text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->address }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Localidade</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-location-arrow text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->city }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Código Postal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-location-arrow text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->zipcode }}" readonly>
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
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-pin text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->zone }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Contactos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-email text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->phone }}" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Nº Propostas em aberto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-comment text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->open_proposals }}" readonly>
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
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-light-bulb text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->open_occurrences }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Saldo em Aberto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-money text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->current_account }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Cheques em carteira</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-bag text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->balance_checks }}" readonly>
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
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-stats-up text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->balance_points }}" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4">

                            <div class="form-group">
                                <label>Condições de pagamento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-carolina"><i
                                                class="ti-credit-card text-light"></i></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $detalhesCliente->customers[0]->payment_conditions }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--  FIM DETALHES   -->
                    </p>
                </div>
                <div class="tab-pane fade {{ $tabProdutos }}" id="tab5">

                    @if ($specificProduct == 0)
                        <div class="row tab-encomenda-produto">

                            <div class="col" wire:key="select-field-model-version-{{ $iteration }}">

                                <div>

                                    @php
                                        $contaCat = 0;
                                    @endphp
                                    @foreach ($getCategories->category as $i => $cat)
                                        @php
                                            $contaCat++;
                                        @endphp
                                        <div class="subsidebarProd overflow-y-auto"
                                            id="subItemInput{{ $contaCat }}">
                                            <div wire:loading wire:target="searchCategory">
                                                <div id="filtroLoader" style="display: block;">
                                                    <div class="filtroLoader" role="status">
                                                    </div>
                                                </div>
                                            </div>

                                            <div wire:loading wire:target="resetFilter">
                                                <div id="filtroLoader" style="display: block;">
                                                    <div class="filtroLoader" role="status">
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="javascript:void(0)" class="buttonGoback"><i
                                                    class="ti ti-arrow-left IconGoback"></i>Produtos</a>
                                            <h2>{{ $cat->name }}</h2>
                                            <div class="row">
                                                @foreach ($cat->family as $family)
                                                    <div class="col-4">
                                                        <a href="javascript:void(0);"
                                                            wire:click="searchCategory({{ $contaCat }},{{ json_encode($family->id) }})">
                                                            <h5 class="family_title">{{ $family->name }}</h5>
                                                        </a>
                                                    </div>
                                                    @if ($familyInfo == true)
                                                        @if ($idFamilyInfo == $family->id)
                                                            <div class="col-12">
                                                                <!-- <div class="row d-flex justify-content-end mr-0"> -->
                                                                <div class="row mb-2">
                                                                    <a href="javascript:void(0)"
                                                                        wire:click="resetFilter({{ $contaCat }})"
                                                                        class="mb-3 ml-4"><i
                                                                        class="ti-angle-left"></i> Atrás</a>
                                                                </div>
                                                                <!-- </div> -->

                                                                <div class="row">
                                                                    @foreach ($family->subfamily as $subfamily)
                                                                        <div class="col-4">
                                                                            <h5 class="title-description-family"
                                                                                wire:click="searchSubFamily({{ $contaCat }},{{ json_encode($family->id) }},{{ json_encode($subfamily->id) }})">
                                                                                {{ $subfamily->name }}</h5>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="sidebarProd" id="sidebarProd" wire:ignore>
                                        <label for="checkbox" style="width: 100%;">
                                            <div class="input-group input-group-config-Goback input-config-produtos"
                                                id="checkboxSidbar" style="padding: 0;">
                                                <label><i class="ti-menu"></i>
                                                    <p>PRODUTOS</p>
                                                </label>
                                            </div>
                                        </label>
                                        @php
                                            $conta = 0;
                                        @endphp
                                        @foreach ($getCategoriesAll->category as $i => $category)
                                            @php
                                                $conta++;
                                            @endphp
                                            @if (!empty($category->family))
                                                <!-- <div class="input-group d-flex input-group-config justify-content-between" wire:click="rechargeFamilys({{ $conta }})" id="input{{ $conta }}" > -->
                                                <div class="input-group d-flex input-group-config justify-content-between"
                                                    id="input{{ $conta }}"
                                                    @if ($category->name == 'Sistemas') style="background-color: #42c69f;"
                                            @elseif($category->name == 'Água') style="background-color: #0179b5;"
                                            @elseif($category->name == 'Conforto') style="background-color: #cd3d3c;"
                                            @elseif($category->name == 'Solar') style="background-color: #cc7d3b;"
                                            @elseif($category->name == 'Ar Condicionado') style="background-color: #9fa2a2;"
                                            @elseif($category->name == 'Ventilação') style="background-color: #141b62;"
                                            @elseif($category->name == 'Marcas') style="background-color: #5c2a5d;"
                                            @elseif($category->name == 'Piscinas') style="background-color: #01cbdf;"
                                            @elseif($category->name == 'Marcas') style="background-color: #5c2a5d;" @endif>
                                                    <p>{{ $category->name }}</p>
                                                    <label>></label>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                    <div class="row justify-content-between">
                                        <div class="col-3">
                                            <div class="input-group" id="checkboxSidbar">
                                                <input id="checkbox" type="checkbox">
                                                <label class="toggle" for="checkbox">
                                                    <div id="bar1" class="bars"></div>
                                                    <div id="bar2" class="bars"></div>
                                                    <div id="bar3" class="bars"></div>
                                                </label> &nbsp;<h4>Categorias</h4>
                                            </div>
                                            <div id="dataTables_wrapper" class="dataTables_wrapper container mt-2"
                                                style="margin-left:0px;padding-left:0px;margin-bottom:10px;">
                                                <div class="dataTables_length" id="dataTables_length">
                                                    <label>Mostrar
                                                        <select name="perPage" wire:model="perPage">
                                                            <option value="10"
                                                                @if ($perPage == 10) selected @endif>10
                                                            </option>
                                                            <option value="25"
                                                                @if ($perPage == 25) selected @endif>25
                                                            </option>
                                                            <option value="50"
                                                                @if ($perPage == 50) selected @endif>50
                                                            </option>
                                                            <option value="100"
                                                                @if ($perPage == 100) selected @endif>100
                                                            </option>
                                                        </select>
                                                        registos</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md col-12">
                                            @php
                                                $searchNameCategory = session('searchNameCategory');
                                                $searchNameFamily = session('searchNameFamily');
                                                $searchNameSubFamily = session('searchNameSubFamily');
                                            @endphp
                                            <ol class="breadcrumb d-flex" style="border-bottom:none;">
                                                @if($searchNameCategory)<li class="breadcrumb-item"><a href="">{{$searchNameCategory}}</a></li>@endif
                                                @if($searchNameFamily)<li class="breadcrumb-item"> {{$searchNameFamily}}</li>@endif
                                                @if($searchNameSubFamily)<li class="breadcrumb-item active">{{$searchNameSubFamily}}</li>@endif
                                            </ol>
                                        </div>
                                        <div class="col-6 col-md">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text search"><i
                                                            class="ti-search text-light"></i></span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    placeholder="Pesquise Produto" wire:model="searchProduct"
                                                    @if (session('searchProduct') !== null) value="{{ session('searchProduct') }}" @endif>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row" style="justify-content: flex-end;">

                                    <div class="navbar2 col-3 d-none d-md-block">
                                            @php
                                                $contaCat = 0;
                                            @endphp
                                            @foreach ($getCategoriesAll->category as $i => $category)
                                                @php
                                                    $contaCat++;
                                                @endphp
                                                @if (!empty($category->family))
                                                    <button class="accordion2" style="background: #5f77921c;">{{ $category->id }} -
                                                        {{ $category->name }}<span
                                                            class="arrow"><i class="fa-regular fa-square-caret-down"></i></span></button>
                                                    <div class="panel2">
                                                        @foreach ($category->family as $family)
                                                            <button class="accordion2" style="background-color: #1791ba26;">{{ $family->id }} -
                                                                {{ $family->name }}<span
                                                                    class="arrow"><i class="fa-regular fa-square-caret-down"></i></span></button>
                                                            <div class="panel2">
                                                                @foreach ($family->subfamily as $subfamily)
                                                                    <a wire:click="searchSubFamily({{ $contaCat }},{{ json_encode($family->id) }},{{ json_encode($subfamily->id) }})"
                                                                        href="#">{{ $subfamily->id }} -
                                                                        {{ $subfamily->name }}</a>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="row col-md-9">

                                            <div wire:loading wire:target="searchProduct">
                                                <div id="filtroLoader" style="display: block;">
                                                    <div class="filtroLoader" role="status">
                                                    </div>
                                                </div>
                                            </div>

                                            <div wire:loading wire:target="adicionarProduto">
                                                <div id="filtroLoader" style="display: block;">
                                                    <div class="filtroLoader" role="status">
                                                    </div>
                                                </div>
                                            </div>

                                            <div wire:loading wire:target="openDetailProduto">
                                                <div id="filtroLoader" style="display: block;">
                                                    <div class="filtroLoader" role="status">
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                $searchSubFamily = session('searchSubFamily');
                                            @endphp

                                            @if ($searchSubFamily)
                                                @foreach ($searchSubFamily->product as $prodt)
                                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                                                        <div
                                                            class="card card-decoration card-outline-primary border border-2">
                                                            <a href="javascript:void(0)"
                                                                wire:click="openDetailProduto({{ json_encode($prodt->category_number) }},{{ json_encode($prodt->family_number) }},{{ json_encode($prodt->subfamily_number) }},{{ json_encode($prodt->product_number) }},{{ json_encode($detalhesCliente->customers[0]->no) }},{{ json_encode($prodt->product_name) }})"
                                                                style="pointer-events: auto">
                                                                <div class="mb-1">
                                                                    <img src="https://storage.sanipower.pt/storage/produtos/{{ $prodt->family_number }}/{{ $prodt->family_number }}-{{ $prodt->subfamily_number }}-{{ $prodt->product_number }}.jpg"
                                                                        class="card-img-top" alt="...">
                                                                    <div class="body-decoration">
                                                                        <h5 class="title-description">
                                                                            {{ $prodt->product_name }}</h5>
                                                                    </div>

                                                                </div>
                                                            </a>

                                                            <div class="card-body container-buttons"
                                                                style="z-index:10;">
                                                                <button class="btn btn-sm btn-primary"
                                                                    wire:click="adicionarProduto({{ json_encode($prodt->category_number) }},{{ json_encode($prodt->family_number) }},{{ json_encode($prodt->subfamily_number) }},{{ json_encode($prodt->product_number) }},{{ json_encode($detalhesCliente->customers[0]->no) }},{{ json_encode($prodt->product_name) }})"><i
                                                                        class="ti-shopping-cart"></i><span> Compra rápida</span></button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="tab-encomenda-produto">
                                <div class="row mb-2 border-bottom">
                                    <a href="javascript:void(0)" wire:click="recuarLista(5)" class="mb-3 ml-4"><i
                                        class="ti-angle-left"></i> Atrás</a>
                                </div>
                                @php
                                    $detailProduto = session('detailProduto');
                                    $produtoNameDetail = session('productNameDetail');
                                    $family = session('family');
                                    $subFamily = session('subFamily');
                                    $productNumber = session('productNumber');
                                @endphp

                                <div class="row container-detalhes-produto">

                                    <div class="col-4 col-md-3" style="padding-left: 0;padding-bottom: 20px;">
                                        <img src="https://storage.sanipower.pt/storage/produtos/{{ $family }}/{{ $family }}-{{ $subFamily }}-{{ $productNumber }}.jpg"
                                            width=100%>
                                    </div>
                                    @php
                                        $ref = "https://storage.sanipower.pt/storage/produtos/$family/$family-$subFamily-$productNumber.jpg";
                                    @endphp
                                    <div class="col-12 col-lg-9">

                                        <div class="row">
                                            <div class="col-xl-12 mb-2">
                                                <div class="row">

                                                    <div class="col-xs-9 d-flex align-middle pl-2"
                                                        style="align-items:center;">
                                                        <h3 id="detailNameProduct">{{ $produtoNameDetail }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive" style="overflow-x:inherit !important;">
                                                <table class="table table-bordered table-hover"
                                                    style="min-width: 995px;">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Referência</th>
                                                            <th>Modelo</th>
                                                            <th>PVP unitário</th>
                                                            <th>Desconto</th>
                                                            <th>Preço unitário</th>
                                                            <th>Qtd mínima</th>
                                                            <th>Stock</th>
                                                            <th style=" width: 150px;">Qtd a encomendar</th>
                                                            <th class="text-center">Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($detailProduto))
                                                            @foreach ($detailProduto->product as $i => $prod)
                                                                <tr>
                                                                    <td>{{ $prod->referense }}</td>
                                                                    <td>{{ $prod->model }}</td>
                                                                    <td>{{ $prod->pvp }}</td>
                                                                    <td>{{ $prod->discount }}</td>
                                                                    <td>{{ $prod->price }}</td>
                                                                    <td>{{ $prod->quantity }}</td>
                                                                    <td style="text-align:center;font-size:large;">
                                                                        @if ($prod->in_stock == true)
                                                                            <a class="popover-test"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Clique para ver os valores">
                                                                                <!-- <i class="ti-check text-lg text-forest"></i>  -->
                                                                                <div class="dropdownIcon">
                                                                                    <i
                                                                                        class="ti-check text-lg text-forest dropdownIcon-toggle"></i>
                                                                                    <ul class="dropdownIcon-menu">
                                                                                        <li><i
                                                                                                class="fa fa-play icon-play"></i>
                                                                                        </li>
                                                                                        <li
                                                                                            style="border-bottom: 1px solid;">
                                                                                            <h5>Stocks em loja</h5>
                                                                                        </li>
                                                                                        @foreach ($prod->stocks as $stock)
                                                                                            <li>

                                                                                                {{ $stock->warehouse }}

                                                                                                @if ($stock->stock == true)
                                                                                                    <i
                                                                                                        class="ti-check text-lg text-forest"></i>
                                                                                                @else
                                                                                                    <i
                                                                                                        class="ti-close text-lg text-chili"></i>
                                                                                                @endif

                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:;" role="button"
                                                                                class="popover-test"
                                                                                data-toggle="popover"
                                                                                aria-describedby="popover817393">
                                                                                <i
                                                                                    class="ti-close text-lg text-chili"></i>
                                                                            </a>
                                                                        @endif

                                                                    </td>
                                                                    <td><input type="number" class="form-control"
                                                                            id="valueEncomendar" data-i="{{$i}}" wire:model.defer="produtosRapida.{{$i}}"></td>
                                                                    <td class="text-center">

                                                                        <a href="javascript:;"
                                                                            class="btn btn-sm btn-outline-secondary">
                                                                            <i class="ti-package text-light"></i>
                                                                        </a>
                                                                        <a href="javascript:;"
                                                                            class="btn btn-sm btn-outline-secondary">
                                                                            <i class="ti-comment text-light"></i>
                                                                        </a>
                                                                        <a href="javascript:;"
                                                                            class="btn btn-sm btn-outline-secondary">
                                                                            <i class="ti-notepad text-light"></i>
                                                                        </a>
                                                                        {{-- vinicius --}}
                                                                        <a href="javascript:;" wire:click="addProductQuickBuy({{$i}},'{{ $produtoNameDetail }}',{{$detalhesCliente->customers[0]->no}},'{{$ref}}','{{$codEncomenda}}')"
                                                                            class="btn btn-sm btn-outline-secondary">
                                                                            <i class="ti-shopping-cart text-light"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container-buttons-produtos">
                                                <div>
                                                    <button class="btn btn-md btn-primary"><i class="ti-file"></i>
                                                        Ficha do Produto</button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-md btn-primary" wire:click="CleanAll"><i class="ti-close"></i>
                                                        Limpar Seleção</button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-md btn-primary" wire:click="addAll('{{$produtoNameDetail}}',{{$detalhesCliente->customers[0]->no}}, '{{ $ref }}','{{$codEncomenda}}')"><i
                                                            class="ti-shopping-cart" ></i> Adicionar Todos </button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-md btn-primary"><i class="ti-info"></i>
                                                        Descrição Produto</button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-md btn-primary"><i class="ti-file"></i>
                                                        Manuais Certificados</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade {{ $tabDetalhesEncomendas }} m-3" id="tab6" style="border: none;">
            @php
                $ValorTotal = 0;
                $ValorTotalComIva = 0;
            @endphp
            @forelse ($arrayCart as $img => $item)
                <div class="row" style="align-items: center;">
                    <div class="col-md-2 d-flex justify-content-center align-items-center p-0">
                        <img src="{{ $img }}" class="card-img-top" alt="Produto" style="width: 12rem; height:auto;">
                    </div>
                    <div class="col-md-10 p-0">
                        <table class="table table-hover init-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="d-none d-lg-table-cell">Referência</th>
                                    <th>Produto</th>
                                    <th>Modelo</th>
                                    <th>PVP (UNI)</th>
                                    <th class="d-none d-md-table-cell">Desconto</th>
                                    <th>Preço (c/desc.)</th>
                                    <th>Qtd.Enc.</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($item as $prod)
                                    @php
                                        $totalItem = $prod->price * $prod->qtd;
                                        $totalItemComIva = $totalItem + ($totalItem * ($prod->iva / 100));
                                        $ValorTotal += $totalItem;
                                        $ValorTotalComIva += $totalItemComIva;
                                    @endphp
                                    <tr data-href="#" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important;">
                                        <td class="d-none d-lg-table-cell" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important;">{{ $prod->referencia }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:22%">{{ $prod->designacao }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:15%">{{ $prod->model }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ number_format($prod->pvp, 2, ',', '.') }} €</td>
                                        <td class="d-none d-md-table-cell" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ $prod->discount }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ number_format($prod->price, 2, ',', '.') }} €</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ $prod->qtd }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ $prod->iva }} %</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ number_format($totalItem, 2, ',', '.') }} €</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:5%"><strong><a href="javascript:void(0);" class="remover_produto btn btn-sm btn-primary" wire:click="deletar({{ $prod->id }})">X</a></strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; text-align:center;">Nenhum produto no carrinho</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="8" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; text-align:center;">Nenhum produto no carrinho</td>
                </tr>
            @endforelse
            <div class="row">
                <div class="col-12 text-right" style="border-bottom: none;">
                    <table class="float-right" style="width: 240px; margin-top: 1rem;">
                        <tbody>
                            <tr style="border-bottom: 1px solid #232b58!important;">
                                <td style="width: 100px; text-align: left;">Total s/IVA</td>
                                <td style="width: 140px;" class="bold">{{ number_format($ValorTotal, 2, ',', '.') }} €</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #232b58!important;">
                                <td style="width: 100px; text-align: left;">Total c/IVA</td>
                                <td style="width: 140px;" class="bold">{{ number_format($ValorTotalComIva, 2, ',', '.') }} €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-12 p-0 d-none d-md-table-cell text-right mt-3">
                    <a class="btn btn-cinzento btn_limpar_carrinho" style="border: #232b58 solid 1px; margin-right: 1rem;" wire:click="deletartodos"><i class="las la-eraser"></i> Limpar Carrinho</a>
                    <a class="btn btn-primary fundo_azul" style="color:white;"><i class="las la-angle-right"></i> Seguinte</a>
                </div>
                <div class="col-12 pb-3 p-0 d-md-none text-center">
                    <a class="btn btn-cinzento btn_limpar_carrinho w-100 mb-2" style="border: #232b58 solid 1px;" wire:click="deletartodos"><i class="las la-eraser"></i> Limpar Carrinho</a>
                    <a class="btn btn-primary fundo_azul w-100" style="color:white;"><i class="las la-angle-right"></i> Seguinte</a>
                </div>
            </div>
        </div>


            {{-- <div class="tab-pane fade {{ $tabDetalhesPropostas }}" id="tab6">

                <p class="card-text">


                <div class="row form-group">
                    <div class="col-xl-4 col-xs-12">

                        <div class="form-group">
                            <label>Referência</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-carolina"><i
                                            class="ti-light-bulb text-light"></i></span>
                                </div>
                                <input type="text" class="form-control"
                                    value="{{ $detalhesCliente->customers[0]->open_occurrences }}" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 col-xs-12">

                        <div class="form-group">
                            <label>Entrega</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-carolina"><i
                                            class="ti-bag text-light"></i></span>
                                </div>
                                <input type="text" class="form-control"
                                    value="{{ $detalhesCliente->customers[0]->balance_checks }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-xs-12">

                        <div class="form-group">
                            <label>Condições de Pagamento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-carolina"><i
                                            class="ti-money text-light"></i></span>
                                </div>
                                <input type="text" class="form-control"
                                    value="{{ $detalhesCliente->customers[0]->balance_checks }}" readonly>
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

                </div> --}}


 <!-- Modal adicionar compra rapida -->
    <div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="modalProdutos"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            @php
                $quickBuyProducts = session('quickBuyProducts');
                $nameProduct = session('productName');
            @endphp
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalProdutos">{{ $nameProduct }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
            $detailProduto = session('detailProduto');
            $produtoNameDetail = session('productNameDetail');
            $family = session('family');
            $subFamily = session('subFamily');
            $productNumber = session('productNumber');
        @endphp
            <div class="col-4 col-md-3" style="padding-left: 0;padding-bottom: 20px; display:none;">
                <img src="https://storage.sanipower.pt/storage/produtos/{{ $family }}/{{ $family }}-{{ $subFamily }}-{{ $productNumber }}.jpg"
                    width=100%>
            </div>
            @php
                $ref = "https://storage.sanipower.pt/storage/produtos/$family/$family-$subFamily-$productNumber.jpg";
            @endphp
            <div class="modal-body" id="scrollModal" style="overflow-y: auto;max-height:500px;">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:none!important;">
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

                                    @if (!empty($quickBuyProducts))
                                        @foreach ($quickBuyProducts->product as $i => $prod)
                                            <tr wire:key="product-{{ $i }}">
                                                <td>{{ $prod->referense }}</td>
                                                <td>{{ $prod->model }}</td>
                                                <td>{{ $prod->pvp }}</td>
                                                <td>{{ $prod->discount }}</td>
                                                <td>{{ $prod->price }}</td>
                                                <td>{{ $prod->quantity }}</td>
                                                <td style="text-align:center;font-size:large;">
                                                    @if ($prod->in_stock == true)
                                                        <a class="popover-test" data-toggle="tooltip" data-placement="top" title="Clique para ver os valores">
                                                            <div class="dropdownIcon">
                                                                <i class="ti-check text-lg text-forest dropdownIcon-toggle"></i>
                                                                <ul class="dropdownIcon-menu">
                                                                    <li><i class="fa fa-play icon-play"></i></li>
                                                                    <li style="border-bottom: 1px solid;">
                                                                        <h5>Stocks em loja</h5>
                                                                    </li>
                                                                    @foreach ($prod->stocks as $stock)
                                                                        <li>
                                                                            {{ $stock->warehouse }}
                                                                            @if ($stock->stock == true)
                                                                                <i class="ti-check text-lg text-forest"></i>
                                                                            @else
                                                                                <i class="ti-close text-lg text-chili"></i>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a href="javascript:;" role="button" class="popover-test" data-toggle="popover" aria-describedby="popover817393">
                                                            <i class="ti-close text-lg text-chili"></i>
                                                        </a>
                                                    @endif
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" data-i="{{$i}}" wire:model.defer="produtosRapida.{{$i}}">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success" wire:click="addProductQuickBuy({{$i}}, '{{ $nameProduct }}', {{$detalhesCliente->customers[0]->no}}, '{{ $ref }}', '{{ $codEncomenda }}')">
                                                        <i class="ti-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="ti-comment"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cleanSelectionQuick" class="btn btn-outline-dark" data-dismiss="modal">Limpar seleção</button>
                <button type="button" class="btn btn-outline-primary" wire:click="addAll('{{$nameProduct}}',{{$detalhesCliente->customers[0]->no}}, '{{ $ref }}','{{$codEncomenda}}')">Adicionar todos</button>
            </div>
        </div>
    </div>
</div>

<!----->

<!-- Modal ver encomenda -->
<div  wire:ignore.self class="modal fade" id="modalEncomenda" tabindex="-1" role="dialog" aria-labelledby="modalEncomenda" aria-hidden="true" >
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary"><i class="ti-archive"></i> Carrinho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:none!important;">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Ref.</th>
                                        <th>Descrição</th>
                                        <th>Qtd.</th>
                                        <th>Preço</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carrinhoCompras as $item)
                                        <tr>
                                            <td style="border-bottom:1px solid #232b58!important; width:10%">{{ $item->referencia }}</td>
                                            <td style="border-bottom:1px solid #232b58!important; width:20%">{{ $item->designacao }}</td>
                                            <td style="border-bottom:1px solid #232b58!important; width:10%">{{ $item->qtd }}</td>
                                            <td style="border-bottom:1px solid #232b58!important; width:10%">{{ number_format($item->price, 2, ',', '.') }} €</td>
                                            <td style="border-bottom:1px solid #232b58!important; width:5%">
                                                <strong>
                                                    <a href="javascript:void(0);" class="remover_produto btn btn-sm btn-primary" wire:click="delete({{ $item->id }})">X</a>
                                                </strong>
                                            </td>
                                        </tr>
                                     @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Nenhum produto no carrinho</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#tab6" id="finalizarEncomenda" data-toggle="tab" class="nav-link btn btn-outline-primary">Finalizar Encomenda</a>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<!-- FIM TABS  -->


</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="crossorigin="anonymous"></script>
@livewireScripts
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Função para fechar todos os dropdowns
        function closeAllDropdowns() {
            var dropdownMenus = document.querySelectorAll('.dropdownIcon-menu');
            dropdownMenus.forEach(function(dropdownMenu) {
                dropdownMenu.style.display = "none";
            });
        }

        // Função para mostrar ou esconder o dropdown
        function toggleDropdown(dropdownBtn) {
            var dropdownMenu = dropdownBtn.nextElementSibling;
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            } else {
                closeAllDropdowns(); // Fecha todos os dropdowns antes de abrir o novo
                dropdownMenu.style.display = "block";
            }
        }

        // Adiciona evento de clique no documento inteiro
        document.addEventListener("click", function(event) {
            // Verifica se o elemento clicado é um botão de dropdown
            if (event.target.classList.contains('dropdownIcon-toggle')) {
                var dropdownBtn = event.target;
                toggleDropdown(dropdownBtn);
            } else {
                // Fecha todos os dropdowns se clicar fora deles
                closeAllDropdowns();
            }
        });
    });


    // vinicius
    const checkbox = document.getElementById('checkbox');

    const sidebar = document.getElementById('sidebarProd');


    checkbox.addEventListener('change', function() {

        const sidebarHasOpenClass = sidebar.classList.contains('open');

        if (this.checked && !sidebarHasOpenClass) {
            sidebar.classList.add('open');
            checkbox.checked = true;
        } else if (!this.checked && sidebarHasOpenClass) {
            sidebar.classList.remove('open');

        }
    });

    window.addEventListener('refreshAllComponent', function() {
        const sidebar = document.getElementById('sidebarProd');
        const subbars = document.querySelectorAll('.subsidebarProd');
        const targetElement = event.target;

        document.querySelectorAll('.subsidebarProd').forEach(function(item) {
            item.style.display = 'none';
        });

        checkbox.checked = true;
        sidebar.classList.remove('open');

        var accordions2 = document.getElementsByClassName("accordion2");

    // Add click event listener to each accordion button
    for (var i = 0; i < accordions2.length; i++) {
        accordions2[i].addEventListener("click", function() {
            // Toggle active class to button
            this.classList.toggle("active");

            // Toggle the panel visibility
            var panel2 = this.nextElementSibling;
            if (panel2.style.maxHeight) {
                panel2.style.maxHeight = null;
                this.querySelector('.arrow').innerHTML = '<i class="fa-regular fa-square-caret-down"></i>'; // Change arrow down
            } else {
                panel2.style.maxHeight = panel2.scrollHeight + "%";
                this.querySelector('.arrow').innerHTML = '<i class="fa-regular fa-square-caret-up"></i>'; // Change arrow up
            }
        });
    }

    });

    window.addEventListener('refreshComponent', function(e) {
        jQuery("#subItemInput" + e.detail.id).css("display", "block");
    });

    const inputProdutos = document.querySelectorAll('.input-config-produtos');
    inputProdutos.forEach(function(inputProduto) {
        inputProduto.addEventListener('click', function() {
            if (inputProduto.classList.contains('open')) {} else {
                sidebar.classList.remove('open');
                document.querySelectorAll('.subsidebarProd').forEach(function(item) {
                    item.style.display = 'none';
                });
            }

        });
    });

    const inputGroups = document.querySelectorAll('.input-group-config');
    let currentSubItem = null;

    inputGroups.forEach(function(inputGroup) {
        inputGroup.addEventListener('click', function() {

            const id = this.id;
            const subItemId = 'subItemInput' + id.slice(-1);
            const InputId = 'input' + id.slice(-1);


            const subItem = document.getElementById(subItemId);
            const Input = document.getElementById(InputId);




            const subbars = document.querySelectorAll('.subsidebarProd');

            if (subItem) {

                const currentDisplayStyle = window.getComputedStyle(subItem).display;

                if (currentDisplayStyle === 'block') {
                    subItem.style.display = 'none';

                } else {
                    document.querySelectorAll('.subsidebarProd').forEach(function(item) {
                        item.style.display = 'none';
                    });

                    // var familyInfo = @this.get('familyInfo');

                    // if (familyInfo) {
                    //     Livewire.emit("rechargeFamilys", id);
                    //     setTimeout(function() {
                    //         subItem.style.display = 'block';
                    //     }, 1500);
                    // } else {
                    subItem.style.display = 'block';
                    // }

                }
                currentSubItem = subItem;
            }
        });
    });

    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebarProd');
        const subbars = document.querySelectorAll('.subsidebarProd');
        const targetElement = event.target;
        if (sidebar) {
            if (!sidebar.contains(targetElement)) {

                let clickedOutsideSubbars = true;
                subbars.forEach(function(subbar) {
                    if (subbar.contains(targetElement)) {

                        clickedOutsideSubbars = false;
                    }
                });

                if (clickedOutsideSubbars) {
                    document.querySelectorAll('.subsidebarProd').forEach(function(item) {
                        item.style.display = 'none';
                    });

                    checkbox.checked = true;
                    sidebar.classList.remove('open');


                } else {
                    checkbox.checked = false;
                }


            }
        } else {}
    });

    jQuery('body').on('click', '.checkboxSidbar', function() {

        const inputProdutos = document.querySelectorAll('.input-config-produtos');
        inputProdutos.forEach(function(inputinputProduto) {});

        document.querySelectorAll('.subsidebarProd').forEach(function(item) {
            item.style.display = 'none';
        });
    });


    jQuery('body').on('click', '.buttonGoback', function() {
        document.querySelectorAll('.subsidebarProd').forEach(function(item) {
            item.style.display = 'none';
        });
    });

    class ScrollableDiv {
        constructor(element) {
            this.element = element;
            this.isScrolling = false;
            this.startX = null;
            this.startScrollLeft = null;

            this.element.addEventListener('mousedown', this.handleMouseDown.bind(this));
            document.addEventListener('mouseup', this.handleMouseUp.bind(this));
            document.addEventListener('mousemove', this.handleMouseMove.bind(this));
        }

        handleMouseDown(event) {
            this.isScrolling = true;
            this.startX = event.clientX;
            this.startScrollLeft = this.element.scrollLeft;
            event.preventDefault();
        }

        handleMouseUp() {
            this.isScrolling = false;
        }

        handleMouseMove(event) {
            if (this.isScrolling) {
                const deltaX = event.clientX - this.startX;
                this.element.scrollLeft = this.startScrollLeft - deltaX;
            }
        }
    }

    const scrollableDivs = document.querySelectorAll('.scrollableDiv');
    scrollableDivs.forEach(function(div) {
        new ScrollableDiv(div);
    });





    var accordions2 = document.getElementsByClassName("accordion2");

    // Add click event listener to each accordion button
    for (var i = 0; i < accordions2.length; i++) {
        accordions2[i].addEventListener("click", function() {
            // Toggle active class to button
            this.classList.toggle("active");

            // Toggle the panel visibility
            var panel2 = this.nextElementSibling;
            if (panel2.style.maxHeight) {
                panel2.style.maxHeight = null;
                this.querySelector('.arrow').innerHTML = '<i class="fa-regular fa-square-caret-down"></i>'; // Change arrow down
            } else {
                panel2.style.maxHeight = panel2.scrollHeight + "%";
                this.querySelector('.arrow').innerHTML = '<i class="fa-regular fa-square-caret-up"></i>'; // Change arrow up
            }
        });
    }

    document.addEventListener('livewire:load', function() {
            Livewire.hook('message.sent', () => {
                document.getElementById('loader').style.display = 'block';
            });

            // Oculta o loader quando o Livewire terminar de carregar
            Livewire.hook('message.processed', () => {
                document.getElementById('loader').style.display = 'none';
            });

    });


    document.getElementById('finalizarEncomenda').addEventListener('click', function() {
        // Fecha o modal
        $('.modal').modal('hide');

        // Adiciona as classes 'show active' à aba especificada
        document.querySelector('#tab6').classList.add('show', 'active');

        // Remove as classes 'show active' das outras abas, se necessário
        var otherTabs = document.querySelectorAll('.tab-pane');
        otherTabs.forEach(function(tab) {
            if (tab.id !== 'tab6') {
                tab.classList.remove('show', 'active');
            }
        });

        // Atualiza o link da navegação para refletir a aba ativa
        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.classList.remove('active');
        });
        document.querySelector('a[href="#tab6"]').classList.add('active');
    });


    jQuery('#cleanSelectionQuick').on('click', function(event) {
        event.stopPropagation();
        event.preventDefault();

        //fazer aqui para limpar as linhas todas
        jQuery('td #valueEncomendar').each(function(){
            jQuery(this).val("");

        })

        jQuery('#modalProdutos').modal('hide');

        Livewire.emit("cleanModal");

    });

    document.addEventListener('deleteModal', function(event) {
    jQuery('#modalEncomenda').modal();

        jQuery('#modalEncomenda').modal('show');
    });

    document.addEventListener('itemDeletar', function (event) {
        // Mudar para a aba #tab6
        var tab = document.querySelector('a[href="#tab6"]');
        if (tab) {
            tab.click();
        }
    });

    document.addEventListener('compraRapida', function(e) {

           jQuery('#modalProdutos').modal();

    });





</script>
