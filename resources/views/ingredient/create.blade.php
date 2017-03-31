@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un ingrédient</h2>

        {!! Form::open(['route' => 'ingredient.store']) !!}
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
            {{ Form::submit('Ajouter l\'ingrédient', ['class' => 'btn btn-primary pull-right']) }}
        {!! Form::close() !!}
    </div>
@endsection