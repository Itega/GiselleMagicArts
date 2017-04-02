@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $fournisseur->FRN_NOM }}</h2>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Liste des ingrédients</h3>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Nom</td>
                    <td>Quantité en stock</td>
                    <td>Date d'arrivée</td>
                    <td>Date Limite de Consommation</td>
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
    </div>
@endsection