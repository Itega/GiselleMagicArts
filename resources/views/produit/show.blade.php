@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h3 style="margin-bottom: 0;">{{ $produit->PRD_NOM }}</h3>
                    </div>
                    @if($produit->PRD_IS_POTION)
                        <div class="col-md-2 offset-col-md-10">
                            <h5 class="text-right" style="margin-top: 30px; margin-bottom: 0;">Diluant : {{ $produit->diluant->DLN_NOM }}</h5>
                        </div>
                    @endif
                </div>
                <small>{{ $produit->PRD_PRIX }} pièces d'or</small>

                <hr style="margin: 0; border-color: rgb(212, 212, 212)">
            </div>
        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col-md-12">
                <p><strong>Recette:</strong> {{ $produit->recette->RCT_NOM }}</p>
            </div>
        </div>
    </div>
@endsection