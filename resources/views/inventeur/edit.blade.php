@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Éditer l'inventeur {{ $inventeur->NVN_NOM }}</h3>

        {!! Form::open(['route' => ['inventeur.update', $inventeur->ID_NVN], 'method' => 'PUT']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NVN_NOM', 'Nom de l\'inventeur') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        {!! Form::text('NVN_NOM', $inventeur->NVN_NOM, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('NVN_PRENOM', 'Prénom de l\'inventeur') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        {!! Form::text('NVN_PRENOM', $inventeur->NVN_PRENOM, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::submit('Éditer l\'inventeur', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection