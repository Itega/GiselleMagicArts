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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection