@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 style="display:inline-block;">{{ $recette->RCT_NOM }}<br><small>par {{ $recette->NVN_PRENOM }} {{ $recette->NVN_NOM }}</small></h2>
                <a class="btn btn-primary pull-right" href="{{ route('recette.edit', $recette->ID_RCT) }}">
                    Editer
                </a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ingrédients</th>
                        <th>Prix</th>
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
                        <td>
                            {{ $ingredient->NGR_PRIX }}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @if ($recette->RCT_VALIDEE == 0)
                {!! Form::open(['route' => ['recette.update', $recette->ID_RCT], 'method' => 'PUT']) !!}
                    {!! Form::submit('Valider la reçette', ['class' => 'btn btn-primary pull-right']) !!}
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection
