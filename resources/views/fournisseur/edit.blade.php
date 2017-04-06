@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Éditer le fournisseur {{ $fournisseur->FRN_NOM }}</h3>

        {!! Form::open(['route' => ['fournisseur.update', $fournisseur->ID_FRN], 'method' => 'PUT']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('FRN_NOM', 'Nom du fournisseur') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        {!! Form::text('FRN_NOM', $fournisseur->FRN_NOM, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::submit('Éditer le fournisseur', ['class' => 'btn btn-primary pull-right']) !!}
        {!! Form::close() !!}
    </div>
@endsection