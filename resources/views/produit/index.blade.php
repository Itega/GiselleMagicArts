@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des produits</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($produits as $k => $produit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('produit.show', $produit->ID_PRD) }}">
                                {{ $produit->PRD_NOM }}
                            </a>
                        </td>
                        <td>{{ $produit->PRD_PRIX }} €</td>
                        <td>{{ $produit->PRD_IS_POTION ? 'Potion' : 'Onguent' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection