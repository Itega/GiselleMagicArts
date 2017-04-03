@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 style="display:inline-block;">Editer la reçette de {{ $recette[0]->RCT_NOM }}</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ingrédient</th>
                    <th>Quantité</th>
                    <th>Fraicheur minimale</th>
                    <th>Fraicheur maximale</th>
                </tr>
                </thead>
                <tbody>
                {!! Form::open(['route' => 'recette.update']) !!}
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
                            {{--{{ $ingredient->QUANTITE }}--}}
                            {!! Form::number('NRG_PRIX', $ingredient->QUANTITE, ['class' => 'form-control', 'step' => '0.01']) !!}
                        </td>
                        <td>
                            {{ $ingredient->FRAICHEUR_MIN }}
                        </td>
                        <td>
                            {{ $ingredient->FRAICHEUR_MAX }}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
                <h2>Ajouter un ingrédient</h2>

                <div class="form-group">
                    {!! Form::label('NRG_NOM', 'Nom') !!}
                    <div class="input-group">
                        <span class="input-group-addon"><strong>@</strong></span>
                        {!! Form::text('NRG_NOM', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('NRG_PRIX', 'Prix') !!}
                    <div class="input-group">
                        <span class="input-group-addon">€</span>
                        {!! Form::number('NRG_PRIX', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                </div>
                {{ Form::submit('Modifier la recette', ['class' => 'btn btn-primary pull-right']) }}
                {!! Form::close() !!}
        </div>
    </div>
@endsection
