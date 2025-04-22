@if ($paginator->hasPages())
    {{-- Pagination Navigation (Top) --}}
    <div class="justify-content-end mt-3">
        <nav>
            <ul class="pagination d-flex justify-content-center gap-2">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="px-2 spaced" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                            class="px-2 spaced">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span class="px-2">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page"><span class="px-2">{{ $page }}</span>
                                </li>
                            @else
                                <li><a href="{{ $url }}" class="px-2">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
                            class="px-2 spaced">&rsaquo;</a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="px-2 spaced" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
        {{-- Item Count (Bottom) --}}
        <div class="d-flex justify-content-end mt-2">
            <small>
                Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong>
                of <strong>{{ $paginator->total() }}</strong> results
            </small>
        </div>
    </div>


@endif
