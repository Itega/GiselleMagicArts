@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des ingrédients</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ingredients as $key => $ing)
                    <tr id="{{ $ing->ID_NGR }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ing->NGR_NOM }}</td>
                        <td>{{ $ing->NGR_PRIX }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection