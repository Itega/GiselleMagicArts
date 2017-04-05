@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('ingredient.create') }}" class="btn btn-primary">Ajouter un ingredient</a>

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
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ingredients as $key => $ing)
                    <tr id="{{ $ing->ID_NGR }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ing->NGR_NOM }}</td>
                        <td>{{ $ing->NGR_PRIX }} €</td>
                        <td class="text-right">
                            {!! Form::open(['route' => ['ingredient.destroy', $ing->ID_NGR], 'method' => 'DELETE']) !!}
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ route('ingredient.create') }}" class="btn btn-primary pull-right" style="margin:20px 0;">Ajouter un ingrédient</a>
        </div>
    </div>
@endsection