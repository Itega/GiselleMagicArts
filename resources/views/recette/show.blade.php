@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 style="display:inline-block;">{{ $recette[0]->PRD_NOM }}</h2>
                @if ($recette[0]->PRD_IS_POTION)
                    <h3 class="pull-right">Diluant : {{ $recette[0]->PRD_DILUANT }}</h3>
                @endif
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ingrédients</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($ingredients as $key => $ingredient)
                    <tr>
                        <td>
                            <p>{{ $loop->iteration }}</p>
                        </td>
                        <td>
                            <a href="{{ route('ingredient.index').'#'.$ingredient->ID_NGR }}">
                                {{ $ingredient->NGR_NOM }}
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <a href="{{ route('recette.index', $ingredient->ID_NGR) }}" class="btn btn-primary center-block">Retour à la liste</a>
    </div>
@endsection
