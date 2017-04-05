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
                    <th class="text-right">Action</th>
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
                        <td class="text-right">
                            <a href="{{ route('recette.edit', $recette->ID_RCT) }}">
                                <i class="glyphicon glyphicon-edit" aria-hidden="true" style="color: #000;"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection