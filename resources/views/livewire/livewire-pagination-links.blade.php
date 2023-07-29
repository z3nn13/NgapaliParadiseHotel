@if ($paginator->hasPages())
    <div class="custom-pagination">

        <p class="text-sm text-gray-700 leading-5">
            @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                -
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            of
            <span class="font-medium">{{ $paginator->total() }}</span>
            results
        </p>

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="prev-btn disabled" disabled>Prev</button>
        @else
            <button class="prev-btn" id="prev-btn" wire:click="previousPage" wire:loading.attr='disabled' rel="prev">Prev</button>
        @endif
        {{-- Pagination Element Here --}}
        <div class="page-numbers">
            @foreach ($elements as $element)
                {{-- Make dots here --}}
                @if (is_string($element))
                    <span class="dots">{{ $element }}</span>
                @endif

                {{-- Links array Here --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="page-btn active" aria-current="page" disabled>{{ $page }}</button>
                        @else
                            <button class="page-btn" wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button class="next-btn" id="next-btn" wire:loading.attr='disabled' rel="next" wire:click="nextPage">Next</button>
        @else
            <button class="next-btn disabled" disabled>Next</button>
        @endif
    </div>
@endif
