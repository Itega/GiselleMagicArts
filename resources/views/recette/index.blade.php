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
                </tr>
                </thead>
                <tbody>
                @foreach ($recettes as $recette)
                    <tr>
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <th>
                            <a href="{{ route('recette.show', $recette->ID_PRD) }}">
                                {{ $recette->PRD_NOM }}
                            </a>
                        </th>
                        <th>
                            <p>{{ $recette->PRD_PRIX }}</p>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection