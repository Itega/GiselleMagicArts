@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Éditer l'ingrédient {{ $ingredient->NGR_NOM }}</h3>

        {!! Form::open(['route' => ['ingredient.update', $ingredient->ID_NGR], 'method' => 'PUT']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NGR_NOM', 'Nom de l\'ingrédient') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        {!! Form::text('NGR_NOM', $ingredient->NGR_NOM, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NGR_PRIX', 'Prix de l\'ingrédient') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-eur"></i>
                        </span>
                        {!! Form::number('NGR_PRIX', $ingredient->NGR_PRIX, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::submit('Éditer l\'ingrédient', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection