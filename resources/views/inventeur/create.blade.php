@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un inventeur</h2>

        {!! Form::open(['route' => 'inventeur.store']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NVN_NOM', 'Nom') !!}
                    <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-tag"></i>
                </span>
                        {!! Form::text('NVN_NOM', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NVN_PRENOM', 'Prénom') !!}
                    <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-tag"></i>
                </span>
                        {!! Form::text('NVN_PRENOM', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit('Ajouter l\'inventeur', ['class' => 'btn btn-primary pull-right']) }}
        {!! Form::close() !!}
    </div>
@endsection