@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Liste des fournisseurs</h2>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                </tr>
                </thead>

                <tbody>
                @foreach($fournisseurs as $k => $fournisseur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $fournisseur->FRN_NOM }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection