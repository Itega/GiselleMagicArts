@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($recettes as $recette)
                <li>
                    <a href="{{ route('recette.show', $recette->ID_PRD) }}">
                        {{ $recette->PRD_NOM }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
