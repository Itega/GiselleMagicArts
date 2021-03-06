<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Magic Arts</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-t-md {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <img src="potion.png" height="200px" />
                <div class="title">
                    Bienvenue sur Magic Arts
                </div>
                <small><strong>Vendeuses de potions de mère en fille</strong></small>

                <div class="links m-t-md">
                    <a href="{{ route('ingredient.index') }}">Ingrédients</a>
                    <a href="{{ route('recette.index') }}">Recettes</a>
                    <a href="{{ route('inventeur.index') }}">Inventeurs</a>
                    <a href="{{ route('fournisseur.index') }}">Fournisseur</a>
                    <a href="{{ route('produit.index') }}">Produit</a>
                </div>
            </div>
        </div>
    </body>
</html>
