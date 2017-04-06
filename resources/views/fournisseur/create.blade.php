@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un fournisseur</h2>

        {!! Form::open(['route' => 'fournisseur.store']) !!}
        <div class="form-group">
            {!! Form::label('FRN_NOM', 'Nom') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-tag"></i>
                </span>
                {!! Form::text('FRN_NOM', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        {{ Form::submit('Ajouter le fournisseur', ['class' => 'btn btn-primary pull-right']) }}
        {!! Form::close() !!}
    </div>
@endsection