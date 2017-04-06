@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $fournisseur->FRN_NOM }}</h2>

        @if($fournisseur->ingredients != null)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Liste des ingrédients</h3>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Quantité en stock</th>
                    <th>Date d'arrivée</th>
                    <th>Date Limite de Consommation</th>
                </tr>
                </thead>

                <tbody>
                @foreach($fournisseur->ingredients as $k => $ingredient)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ingredient->NGR_NOM }}</td>
                        <td>{{ $ingredient->QUANTITE_STOCK }}</td>
                        <td>{{ $ingredient->DATE_D_ARRIVEE }}</td>
                        <td>{{ $ingredient->FRAICHEUR_MAX }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
@endsection