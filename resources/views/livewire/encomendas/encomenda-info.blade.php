<div>

    <!--  LOADING -->
    @if ($showLoaderPrincipal == true)
        <div id="loader" style="display: none;">
            <div class="loader" role="status">

            </div>
        </div>
    @endif

    <!-- FIM LOADING -->

    <!-- TABS  -->

    <div class="card card-tabs-pills mb-3">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="#tab4" data-toggle="tab" class="nav-link {{ $tabDetail }}">Detalhes</a>
                </li>
                <li class="nav-item">
                    <a href="#tab6" data-toggle="tab" class="nav-link {{ $tabDetalhesEncomendas }}">Artigos</a>
                </li>
            </ul>

            <div class="teste" style="padding-right:35px;">
                <div class="row group-buttons group-buttons d-flex justify-content-end mr-0 mb-2">
                    <div class="tools">
                        <a href="javascript:void(0);" wire:click="enviarEmail({{ json_encode($encomenda) }})" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i> Enviar email</a>
                        <a href="javascript:void(0);" wire:click="gerarPdfProposta({{ json_encode($encomenda) }})" class="btn btn-sm btn-secondary"> Gerar PDF</a>
                        <a href="javascript:void(0);" wire:click="goBack" class="btn btn-sm btn-secondary"> Voltar atrás</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body" id="scrollModalBody" style="overflow-y:auto;max-height:70vh;padding-right: 0;">
            <div class="tab-content">
               
                <div class="tab-pane fade {{ $tabDetail }}" id="tab4">

                <div style="display:flex;align-items: center;">
                    <h4 class="card-title" style="margin-bottom: 0;">{{ $encomenda->order }} - {{ $encomenda->name }}</h4>
                    <button class="btn btn-sm btn-primary text-left" style="margin-left: 10px;margin-right: 10px;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-info"></i>
                    </button>
                </div>  
                    <div class="row ml-0 mr-0 mt-4 d-block">

                        <div class="accordion" id="accordionExample">
                            <div class="card" style="margin-left: 18px;margin-right: 34px;">
                           
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-xl-4">

                                            <div class="form-group">
                                                <label>Nome do Cliente</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-carolina"><i
                                                                class="ti-user text-light"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $encomenda->name }}" readonly>
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
                                                        value="{{ $encomenda->number }}" readonly>
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
                                                        value="{{ $encomenda->nif }}" readonly>
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
                                                        value="{{ $encomenda->address }}" readonly>
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
                                                        value="{{ $encomenda->city }}" readonly>
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
                                                        value="{{ $encomenda->zipcode }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">

                                        <div class="col-xl-4">

                                            <div class="form-group">
                                                <label>Email do Cliente</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-carolina"><i
                                                                class="ti-pin text-light"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $encomenda->email }}" readonly>
                                                </div>
                                            </div>
                
                                        </div>

                                        <div class="col-xl-4">

                                            <div class="form-group">
                                                <label>Zona do Cliente</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-carolina"><i
                                                                class="ti-pin text-light"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $encomenda->zone }}" readonly>
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
                                                        value="{{ $encomenda->payment_conditions }}" readonly>
                                                </div>
                                            </div>
                
                                        </div>


                                    </div>




                                </div>
                            </div>
                            </div>
                        </div>


                    </div>


                    <div class="row form-group mt-2">
                        <div class="col-12 pr-0">
                            <div class="accordion" id="accordionExample">
                                <div class="card" style="margin-left: 18px;margin-right: 34px;">
                                    <button class="btn btn-block text-left pl-0" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h5 class="pl-2">Comentários</h5>
                                    </button>
    
                                    <div id="collapseTwo" class="collapse">
                                        <div class="card-body">
                                            <div class="timeline-wrapper">
                                                @isset($comentario)
                                                    @foreach ($comentario as $comentarios)
                                                        <div class="timeline-item" data-date="{{ $comentarios->created_at }} &#8594; {{ $comentarios->user->name }}">
                                                            <p>{{ $comentarios->comentario }}</p>
                                                        </div>
                                                    @endforeach
                                                @endisset
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="card-body" style="margin-left:15px;margin-right:15px;">
                                                <hr>
                                                <button type="button" class="btn btn-outline-success" wire:click="openComentario({{ json_encode($encomenda->id) }})">Adicionar Comentário</button>
                                                                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    


                </div>
         
            <div class="tab-pane fade {{ $tabDetalhesEncomendas }} m-3" id="tab6" style="border: none;">
           
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
                                    <th>Descrição</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th class="d-none d-md-table-cell">Desconto</th>
                                    <th>Desconto 2</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($item as $prod)
                                    <tr data-href="#" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important;">
                                        <td class="d-none d-lg-table-cell" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important;">{{ $prod->reference }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:22%">{{ $prod->description }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:15%">{{ $prod->quantity }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ number_format($prod->price, 2, ',', '.') }} €</td>
                                        <td class="d-none d-md-table-cell" style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ $prod->discount }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ $prod->discount2 }}</td>
                                        <td style="border-top:1px solid #232b58!important; border-bottom:1px solid #232b58!important; width:10%">{{ number_format($prod->total, 2, ',', '.') }} €</td>
                                    
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
                                    <td style="width: 100px; text-align: left;">Total</td>
                                    <td style="width: 140px;" class="bold">{{ number_format($encomenda->total, 2, ',', '.') }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
          
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->

    <div class="modal fade" id="modalProposta" tabindex="-1" role="dialog" aria-labelledby="modalProposta" aria-hidden="true" >
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary"><i class="ti-archive"></i> Envio de Email</h5>
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
                                            <th>Check</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($emailArray != null)
                                           
                                            @foreach ($emailArray as $i => $item)
                                                <tr>
                                                    <td>
                                                        <div class="form-checkbox">
                                                            <label>
                                                                <input type="checkbox" id="emailCheckBox" wire:model.defer="emailSend.{{$i}}">
                                                                <span class="checkmark"><i class="fa fa-check pick"></i></span>
                                                            </label>
                                                        </div>
                                                    </td>

                                                    <td>{{ $item }}</td>
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
                    <a href="#tab6" id="enviarEmailClientes" wire:click="enviarEmailClientes({{json_encode($encomenda)}})" data-toggle="tab" class="nav-link btn btn-outline-primary">Enviar Email</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="modalComentario" aria-hidden="true" >
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary"><i class="ti-archive"></i> Adicionar Comentário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                           
                    <div class="input-group mb-2">
                        <textarea type="text" class="form-control" cols="4" rows="4" style="resize: none;" wire:model.defer="comentarioEncomenda"></textarea>
                    </div>
                          
                       
                </div>
                <div class="modal-footer">
                    <a href="#tab6" id="sendComentario" wire:click="sendComentario({{json_encode($encomendaComentarioId)}})" data-toggle="tab" class="nav-link btn btn-outline-primary">Adicionar Comentário</a>
                </div>
            </div>
        </div>
    </div>
  
    <script>
        window.addEventListener('chooseEmail', function(e) {
            $("#emailCheckBox").prop('checked', false);
            $("#modalProposta").modal();

            
        });

        window.addEventListener('openComentario', function(e) {
            $("#modalComentario").modal();
        });
    </script>
</div>



