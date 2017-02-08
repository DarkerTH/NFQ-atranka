@if ($paginator->lastPage() > 1)
    <ul class="pagination justify-content-center">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url(1) }}&query={{ $string }}&sortBy={{ $sortBy  }}&order={{ $order  }}" aria-label="Atgal">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Atgal</span>
            </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}&query={{ $string }}&sortBy={{ $sortBy  }}&order={{ $order  }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}&query={{ $string }}&sortBy={{ $sortBy  }}&order={{ $order  }}" aria-label="Pirmyn">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Pirmyn</span>
            </a>
        </li>
    </ul>
@endif