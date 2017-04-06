@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('recette.create') }}" class="btn btn-primary">Ajouter une recette</a>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des recettes</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Inventeur</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recettes as $recette)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('recette.show', $recette->ID_RCT) }}">
                                {{ $recette->RCT_NOM }}
                            </a>
                        </td>
                        <td>
                            {{ $recette->NVN_PRENOM }}
                             
                            {{ $recette->NVN_NOM }}
                        </td>
                        <td class="text-right">
                            <a href="{{ route('recette.edit', $recette->ID_RCT) }}">
                                <i class="glyphicon glyphicon-edit" aria-hidden="true" style="margin-right: 5px; color: #000;"></i>
                            </a>
                            {!! Form::open(['route' => ['recette.destroy', $recette->ID_RCT], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
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