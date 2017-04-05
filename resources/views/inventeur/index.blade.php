@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('inventeur.create') }}" class="btn btn-primary">Ajouter un inventeur</a>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des inventeurs</h2>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventeurs as $k => $inventeur)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('inventeur.show', $inventeur->ID_NVN) }}">
                                    {{ $inventeur->NVN_NOM }}
                                </a>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('inventeur.edit', $inventeur->ID_NVN) }}" style="margin-right: 5px; color: #000;">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                {!! Form::open(['route' => ['inventeur.destroy', $inventeur->ID_NVN], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
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