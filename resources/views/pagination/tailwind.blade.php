@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white/50 border border-gray-200 cursor-default leading-5 rounded-lg">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-primary bg-white/80 border border-primary/20 leading-5 rounded-lg hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/20 transition ease-in-out duration-150 disabled:opacity-50">
                    {!! __('pagination.previous') !!}
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-primary bg-white/80 border border-primary/20 leading-5 rounded-lg hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/20 transition ease-in-out duration-150 disabled:opacity-50">
                    {!! __('pagination.next') !!}
                </button>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white/50 border border-gray-200 cursor-default leading-5 rounded-lg">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-sm text-gray-600 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium text-primary">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium text-primary">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium text-primary">{{ $paginator->total() }}</span>
                    {!! __('wishes') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-lg">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white/50 border border-gray-200 cursor-default rounded-l-lg leading-5"
                                aria-hidden="true">
                                <i class="ri-arrow-left-line"></i>
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                            class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-primary bg-white/80 border border-primary/20 rounded-l-lg leading-5 hover:bg-primary/10 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary/20 transition ease-in-out duration-150 disabled:opacity-50"
                            aria-label="{{ __('pagination.previous') }}">
                            <i class="ri-arrow-left-line"></i>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white/80 border border-gray-200 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-primary border border-primary cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-primary bg-white/80 border border-primary/20 leading-5 hover:bg-primary/10 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary/20 transition ease-in-out duration-150 disabled:opacity-50"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                            class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-primary bg-white/80 border border-primary/20 rounded-r-lg leading-5 hover:bg-primary/10 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary/20 transition ease-in-out duration-150 disabled:opacity-50"
                            aria-label="{{ __('pagination.next') }}">
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-400 bg-white/50 border border-gray-200 cursor-default rounded-r-lg leading-5"
                                aria-hidden="true">
                                <i class="ri-arrow-right-line"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
