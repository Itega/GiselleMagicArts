@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $inventeur->NVN_NOM }}</h3>

        <div class="panel panel-default"> <!-- TODO Collapse panel -->
            <div class="panel-heading">
                <h5>Ces recettes</h5>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Température de cuisson</th>
                    <th>État</th>
                </tr>
                </thead>

                <tbody>
                @foreach($inventeur->recettes as $k => $recette)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('recette.show', $recette->ID_RCT) }}">{{ $recette->RCT_NOM }}</a></td>
                        <td>{{ $recette->RCT_TEMPERATURE }} °c</td>
                        <td>{{ $recette->RCT_VALIDEE ? 'Recette validée' : 'Recette en attente de validation' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection