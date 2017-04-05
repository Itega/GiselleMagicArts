@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Créer une reçette</h3>

        {!! Form::open(['route' => 'recette.store']) !!}
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('RCT_NOM', 'Nom de la reçette') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        {!! Form::text('RCT_NOM', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('ID_NVN', 'Inventeur') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        {!! Form::select('ID_NVN', $inventeurs, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('RCT_TEMPERATURE', 'Température de préparation') !!}
                    <div class="input-group">
                        {!! Form::number('RCT_TEMPERATURE', 0, ['class' => 'form-control', 'step' => '1']) !!}
                        <span class="input-group-addon">°c</span>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::submit('Ajouter une reçette', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection