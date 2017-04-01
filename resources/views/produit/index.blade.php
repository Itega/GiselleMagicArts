@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($produits as $k => $produit)
            <p>{{ $produit->PRD_NOM }}</p>
        @endforeach
    </div>
@endsection