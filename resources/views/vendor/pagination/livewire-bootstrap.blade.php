@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Botão Anterior --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Anterior</span></li>
        @else
            <li class="page-item">
                <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled">Anterior</button>
            </li>
        @endif

        {{-- Elementos de Paginação --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separador --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Links de Página --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item">
                            <button class="page-link" wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled">{{ $page }}</button>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botão Próximo --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button class="page-link" wire:click="nextPage" wire:loading.attr="disabled">Próximo</button>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">Próximo</span></li>
        @endif
    </ul>
@endif
