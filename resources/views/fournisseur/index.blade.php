@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('fournisseur.create') }}" class="btn btn-primary">Ajouter un fournisseur</a>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des fournisseurs</h2>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($fournisseurs as $k => $fournisseur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('fournisseur.show', $fournisseur->ID_FRN) }}">
                                {{ $fournisseur->FRN_NOM }}
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('fournisseur.edit', $fournisseur->ID_FRN) }}" style="margin-right: 5px; color: #000;">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['fournisseur.destroy', $fournisseur->ID_FRN], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection