@extends('layouts.app')
@section('title', 'Restaurantes')

@section('content')
<h1 class="mb-3">Restaurantes</h1>

@auth
    <a href="{{ route('restaurants.create') }}" class="btn btn-primary mb-3">Añadir restaurante</a>
@endauth

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Favoritos</th><th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($restaurants as $r)
        <tr>
            <td>{{ $r->name }}</td>
            <td>{{ $r->address }}</td>
            <td>{{ $r->phone }}</td>
            <td>{{ $r->favorited_by_count }}</td>
            <td><a href="{{ route('restaurants.show', $r) }}" class="btn btn-sm btn-outline-secondary">Ver</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $restaurants->links() }}
@endsection
