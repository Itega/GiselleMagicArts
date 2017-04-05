@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 style="display:inline-block;">Editer la reçette de {{ $recette->RCT_NOM }}</h2>
            </div>
            {!! Form::open(['route' => ['utiliser.update', $recette->ID_RCT], 'method' => 'PUT']) !!}
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ingrédient</th>
                    <th>Quantité</th>
                    <th>Fraicheur minimale</th>
                    <th>Fraicheur maximale</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($ingredients as $k => $ingredient)
                    <tr>
                        <td>
                            <p>{{ $loop->iteration }}</p>
                        </td>
                        <td>
                            <a href="{{ route('ingredient.index').'#'.$ingredient->ID_NGR }}">
                                {{ $ingredient->NGR_NOM }}
                            </a>
                            {!! Form::hidden('ID_NGR' . $loop->iteration, $ingredient->ID_NGR) !!}
                        </td>
                        <td>
                            {!! Form::number('QUANTITE' . $loop->iteration, $ingredient->QUANTITE, ['class' => 'form-control', 'step' => '1']) !!}
                        </td>
                        <td>
                            {!! Form::number('FRAICHEUR_MIN' . $loop->iteration, $ingredient->FRAICHEUR_MIN, ['class' => 'form-control', 'step' => '1']) !!}
                        </td>
                        <td>
                            {!! Form::number('FRAICHEUR_MAX' . $loop->iteration, $ingredient->FRAICHEUR_MAX, ['class' => 'form-control', 'step' => '1']) !!}
                        </td>
                        <td class="text-center">
                            <a href="{{ action('UtiliserController@detruire', ['id' => $recette->ID_RCT, 'ing' => $ingredient->ID_NGR]) }}">
                                X
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        <p>+</p>
                    </td>
                    <td>
                        {!! Form::select('ID_NGR', $array, null, ['placeholder' => 'Ajouter un ingrédient ...']) !!}
                    </td>
                    <td>
                        {!! Form::number('QUANTITE', null, ['class' => 'form-control', 'step' => '1']) !!}
                    </td>
                    <td>
                        {!! Form::number('FRAICHEUR_MIN', null, ['class' => 'form-control', 'step' => '1']) !!}
                    </td>
                    <td>
                        {!! Form::number('FRAICHEUR_MAX', null, ['class' => 'form-control', 'step' => '1']) !!}
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <br>
            {!! Form::submit('Modifier', ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
            <br>
            <br>
        </div>
    </div>
@endsection
