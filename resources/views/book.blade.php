@extends('layout.base')

@section('content')
    <div class="col-12 col-md-auto">
        @include('logo')

        @include('search-form')

        <div class="row justify-content-md-center">
            <table class="table table-sm">
                <tr>
                    <td><b>Pavadinimas</b></td>
                    <td>{{ $book->title  }}</td>
                </tr>
                <tr>
                    <td><b>Leidimo metai</b></td>
                    <td>{{ $book->year }}</td>
                </tr>
                <tr>
                    <td><b>Autorius</b></td>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <td><b>Žanras</b></td>
                    <td>{{ $book->genre  }}</td>
                </tr>
            </table>
        </div>

        @if (!empty($r))
            <div class="row justify-content-md-center">
                <a href="{{ $r }}" class="btn btn-primary">Grįžti</a>
            </div>
        @endif

    </div>

@endsection