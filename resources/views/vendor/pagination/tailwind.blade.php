@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 text-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed font-medium shadow-sm">
                <i class="fas fa-chevron-left mr-1"></i> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600 transition duration-200 ease-in-out font-medium shadow-md">
                <i class="fas fa-chevron-left mr-1"></i> Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex flex-wrap justify-center items-center -space-x-px">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="px-4 py-2 leading-tight text-white bg-orange-600 border border-orange-600 font-bold shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-orange-100 hover:text-orange-700 transition duration-200 ease-in-out font-medium shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600 transition duration-200 ease-in-out font-medium shadow-md">
                Next <i class="fas fa-chevron-right ml-1"></i>
            </a>
        @else
            <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed font-medium shadow-sm">
                Next <i class="fas fa-chevron-right ml-1"></i>
            </span>
        @endif
    </nav>
@endif