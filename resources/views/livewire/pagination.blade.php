<div id="pagination_wrapper" class="dataTables_wrapper">
    <div id="dataTables_pagination_info" class="dataTables_info" role="status">
        @if ($this->totalRecords == 0)
            <p>Não foram encontrados registos para exibir.</p>
        @else
            @php
                $numero_registos = $this->totalRecords;

                $primeiro_numero = $this->pageChosen * $this->perPage ;
                $ultimo_numero = ($this->pageChosen + 1) * $this->perPage - 1; 
                
                $primeiro_numero = $primeiro_numero - ($this->perPage - 1);
                $ultimo_numero = $ultimo_numero - ($this->perPage - 1);

                if($ultimo_numero > $numero_registos)
                {
                    $ultimo_numero = $numero_registos;
                }
            @endphp

            <p>Mostrar de {{ $primeiro_numero }} até {{ $ultimo_numero }} de {{ $this->totalRecords }} registos</p>
        @endif
    </div>
  
    <div class="dataTables_paginate paging_simple_numbers" id="dataTables_page_numbers">
        @if($this->pageChosen != 1)
            <a wire:click="previousPage" dusk="previousPage.before" class="paginate_button previous btn btn-primary text-white">Anterior</a>
        @endif

        @if ($paginator->total() > 0)
            @foreach ($this->getPageRange() as $page)
                @if($page != 0)
                    <span>
                        <a class="paginate_button text-white btn {{ $this->isCurrentPage($page) ? 'btn-primary current' : 'btn-secondary' }}" id="page-{{ $page }}" data-dt-idx="{{ $page }}" tabindex="0" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                    </span>
                @endif
            @endforeach
        @endif
    
        @if ($this->pageChosen < $this->numberMaxPages)
            <a wire:click="nextPage" dusk="nextPage.after" class="paginate_button next btn btn-primary text-white" data-dt-idx="{{ $paginator->currentPage() + 1 }}" tabindex="{{ $paginator->currentPage() + 1 }}">Próxima</a>
        @endif
    </div>

</div>



