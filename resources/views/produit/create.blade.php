@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Créer un nouveau produit</h3>

        {!! Form::open(['route' => 'produit.store']) !!}
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('PRD_NOM', 'Nom du produit') !!}
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-tag"></i>
                    </span>
                        {!! Form::text('PRD_NOM', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('PRD_PRIX', 'Prix du produit') !!}
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-eur"></i>
                    </span>
                        {!! Form::number('PRD_PRIX', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('ID_RCP', 'Récipient') !!}
                    {!! Form::select('ID_RCP', $recipients, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        {!! Form::submit('Ajouter un produit', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection