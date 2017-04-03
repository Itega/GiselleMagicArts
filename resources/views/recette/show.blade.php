@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 style="display:inline-block;">{{ $recette[0]->RCT_NOM }}</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ingrédients</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($ingredients as $key => $ingredient)
                    <tr>
                        <td>
                            <p>{{ $loop->iteration }}</p>
                        </td>
                        <td>
                            <a href="{{ route('ingredient.index').'#'.$ingredient->ID_NGR }}">
                                {{ $ingredient->NGR_NOM }}
                            </a>
                        </td>
                        <td>
                            {{ $ingredient->NGR_PRIX }}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
