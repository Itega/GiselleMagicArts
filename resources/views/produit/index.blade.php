@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('produit.create') }}" class="btn btn-primary">Ajouter un produit</a>

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
                    <th class="text-right">Actions</th>
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
                        <td class="text-right">
                            <a href="{{ route('produit.edit', $produit->ID_PRD) }}" style="margin-right: 5px; color: #000;">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['produit.destroy', $produit->ID_PRD], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection