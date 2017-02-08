@extends('layout.base')

@section('content')
    <div class="col-12 col-md-auto">
        @include('logo')

        @include('search-form')

        <div class="row justify-content-md-center">
            <span style="padding-bottom: 1rem; ">
                <b>Ieškoma:</b> <i>{{ $string  }}</i>
            </span>
            <table class="table table-bordered table-hover">
                <thead class="thead-default">
                <tr>
                    <th style="width: 45%;">
                        <a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'title', 'order' => $invertOrder]) }}">Pavadinimas</a>@if ($sortBy == 'title') <i class="fa fa-sort-{{ $order }}" aria-hidden="true"></i> @endif</th>
                    <th style="width: 15%;">
                        <a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'year', 'order' => $invertOrder]) }}">Leidimo metai</a>@if ($sortBy == 'year') <i class="fa fa-sort-{{ $order }}" aria-hidden="true"></i> @endif</th>
                    <th style="width: 25%;">
                        <a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'author', 'order' => $invertOrder]) }}">Autorius</a>@if ($sortBy == 'author') <i class="fa fa-sort-{{ $order }}" aria-hidden="true"></i> @endif</th>
                    <th style="width: 15%;">
                        <a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'genre', 'order' => $invertOrder]) }}">Žanras</a>@if ($sortBy == 'genre') <i class="fa fa-sort-{{ $order }}" aria-hidden="true"></i> @endif</th>
                </tr>
                </thead>
                @forelse ($books as $book)
                    <tr>
                        <td><a href="{{ url('/') }}/book/{{ $book->id }}/?r={{ urlencode(\Request::fullUrl()) }}">{{ $book->title }}</a></td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">Knygų rasti nepavyko.</td>
                    </tr>
                @endforelse
            </table>
        </div>

        @include('pagination.default', ['paginator' => $books])
    </div>

@endsection