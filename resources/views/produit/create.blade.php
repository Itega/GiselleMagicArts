@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Créer un nouveau produit</h3>

        {!! Form::open(['route' => 'produit.store']) !!}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('PRD_NOM', 'Nom du produit') !!}
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    {!! Form::text('PRD_NOM', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('PRD_PRIX', 'Prix du produit') !!}
                <div class="input-group">
                    <span class="input-group-addon">€</span>
                    {!! Form::number('PRD_PRIX', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('ID_DLN', 'Diluant') !!}
                {!! Form::select('ID_DLN', $diluants, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('ID_RCT', 'Recette') !!}
                {!! Form::select('ID_RCT', $recettes, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        {!! Form::submit('Ajouter un produit', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection