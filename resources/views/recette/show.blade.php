@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>{{ $recette[0]->PRD_NOM }}</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ingrédients</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                @if ($recette[0]->PRD_IS_POTION)
                    <td>{{ $recette[0]->PRD_DILUANT }}</td>
                @endif

                @foreach ($ingredients as $key => $ingredient)
                    <td>
                        {{--<a href="{{ route('ingredient.show', $ingredient->ID_NGR) }}">--}}
                            {{ $ingredient->ID_NGR }}
                        {{--</a>--}}
                    </td>
                    <td>
                        {{--<a href="{{ route('ingredient.show', $ingredient->ID_NGR) }}">--}}
                            {{ $ingredient->NGR_NOM }}
                        {{--</a>--}}
                    </td>
                @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
