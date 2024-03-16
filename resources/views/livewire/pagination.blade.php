<div id="pagination_wrapper" class="dataTables_wrapper">
    <div id="dataTables_pagination_info" class="dataTables_info" role="status">
        @if ($paginator->total() > 0)
            {{ __('Showing :initial to :final of :total entries', ['initial' => ($paginator->currentPage() - 1) * $paginator->perPage() + 1, 'final' => min($paginator->currentPage() * $paginator->perPage(), $paginator->total()), 'total' => $paginator->total()]) }}
        @else
            {{ __('No entries to show.') }}
        @endif
    </div>
  
    <div class="dataTables_paginate paging_simple_numbers" id="dataTables_page_numbers">
        
        <a wire:click="previousPage" dusk="previousPage.before" class="paginate_button previous btn btn-primary text-white">{{ __('Previous') }}</a>
       

        @if ($paginator->total() > 0)
            @foreach ($this->getPageRange() as $page)
                <span>
                    <a class="paginate_button text-white btn {{ $this->isCurrentPage($page) ? 'btn-primary current' : 'btn-secondary' }}" id="page-{{ $page }}" data-dt-idx="{{ $page }}" tabindex="0" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                </span>
            @endforeach
        @endif
    
        @if ($this->pageChosen < $this->numberMaxPages)
            <a wire:click="nextPage" dusk="nextPage.after" class="paginate_button next btn btn-primary text-white" data-dt-idx="{{ $paginator->currentPage() + 1 }}" tabindex="{{ $paginator->currentPage() + 1 }}">{{ __('Next') }}</a>
        @endif
    </div>
</div>



