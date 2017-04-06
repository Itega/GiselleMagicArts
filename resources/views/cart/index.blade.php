@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Panier</h2>

        @if(Session::has('cart.info'))
            <div class="alert alert-success" role="alert">
                <strong>Bien joué!</strong> {{ Session::get('cart.info') }}
            </div>
        @endif

        @if($produits != null)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Produit</h4>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix unitaire</th>
                        <th>Potion ?</th>
                        <th>Quantité</th>
                        <th class="text-right">Prix total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach($produits as $id => $produit)
                        <tr>
                            <td>{{ $produit->PRD_NOM }}</td>
                            <td>{{ $produit->PRD_PRIX }} €</td>
                            <td>{{ $produit->PRD_IS_POTION ? 'Oui' : 'Non' }}</td>
                            <td>{{ $produit->quantity }}</td>
                            <td class="text-right">{{ $produit->PRD_PRIX * $produit->quantity }} €</td>
                            <?php $total += $produit->PRD_PRIX * $produit->quantity; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="4">Total</td>
                        <td class="text-right">{{ $total }} €</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif

        @if($ingredients != null)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Ingrédients</h4>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th class="text-right">Prix total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach($ingredients as $id => $ingredient)
                        <tr>
                            <td>{{ $ingredient->NGR_NOM }}</td>
                            <td>{{ $ingredient->NGR_PRIX }} €</td>
                            <td>{{ $ingredient->quantity }}</td>
                            <td class="text-right">{{ $ingredient->NGR_PRIX * $ingredient->quantity }} €</td>
                        </tr>
                        <?php $total += $ingredient->NGR_PRIX * $ingredient->quantity; ?>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="3">Total</td>
                        <td class="text-right">{{ $total }} €</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif

        @if($produits != null || $ingredients != null)
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary pull-right">Commander</a>
        @else
            @if(!Session::has('cart.info'))
                <div class="alert alert-info" role="alert">
                    Vous n'avez aucun article dans votre panier. <a href="{{ route('produit.index') }}" style="color:#000;"><strong>Par ici pour commander</strong></a>
                </div>
            @endif
        @endif
    </div>
@endsection