@extends('layout.base')

@section('content')
    <div class="col-12 col-md-auto">
        @include('logo')

        @include('search-form')

        <div class="row justify-content-md-center">
            <table class="table table-bordered table-hover">
                <thead class="thead-default">
                    <tr>
                        <th style="width: 45%;"><a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'title', 'order' => $order]) }}">Pavadinimas</a></th>
                        <th style="width: 15%;"><a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'year', 'order' => $order]) }}">Leidimo metai</a></th>
                        <th style="width: 25%;"><a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'author', 'order' => $order]) }}">Autorius</a></th>
                        <th style="width: 15%;"><a href="{{ \Request::fullUrlWithQuery(['sortBy' => 'genre', 'order' => $order]) }}">Žanras</a></th>
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
                        <td class="text-center" colspan="4">Knygų duomenų bazė tuščia.</td>
                    </tr>
                @endforelse
            </table>
        </div>

        @include('pagination.default', ['paginator' => $books])
    </div>

@endsection