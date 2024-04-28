@if ($paginator->hasPages())
    <ul>
        <li><a href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li>
                        @if ($page == $paginator->currentPage())
                            <a class="active">{{ $page }}</a>
                        @else (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach
        <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
    </ul>
@endif