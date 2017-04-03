@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des reçettes</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recettes as $recette)
                    <tr>
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <th>
                            <a href="{{ route('recette.show', $recette->ID_RCT) }}">
                                {{ $recette->RCT_NOM }}
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('recette.edit', $recette->ID_RCT) }}">
                                Editer
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection