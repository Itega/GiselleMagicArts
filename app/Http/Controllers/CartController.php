<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller {

    public function index(Request $request) {
        $cart = $request->session()->get('cart.pro');
        $produits = null;
        if($cart != null) {
            foreach ($cart as $id => $quantity) {
                $produits[$id] = DB::select(DB::raw('SELECT * FROM produit WHERE ID_PRD = '. $id))[0];
                $produits[$id]->quantity = $quantity;
            }
        }

        $ingredients = null;
        $cart = $request->session()->get('cart.ing');
        if($cart != null) {
            foreach ($cart as $id => $quantity) {
                $ingredients[$id] = DB::select(DB::raw('SELECT * FROM ingredient WHERE ID_NGR = '. $id))[0];
                $ingredients[$id]->quantity = $quantity;
            }
        }


        return view('cart.index', compact('produits', 'ingredients'));
    }

    public function addProduit($id, Request $request) {
        $session = $request->session();

        if($session->has('cart.pro.'. $id)) {
            $session->put('cart.pro.' . $id, $session->get('cart.pro.' . $id) + 1);
        }
        else
            $session->put('cart.pro.'. $id, 1);

        return redirect(route('cart.index'));
    }

    public function addIngredient($id, Request $request) {
        $session = $request->session();

        if($session->has('cart.ing.'. $id)) {
            $session->put('cart.ing.' . $id, $session->get('cart.ing.' . $id) + 1);
        }
        else
            $session->put('cart.ing.'. $id, 1);

        return redirect(route('cart.index'));
    }

    public function checkout(Request $request) {
        $request->session()->forget('cart');
        $request->session()->flash('cart.info', 'Votre commande à bien été prit en compte.');

        return redirect(route('cart.index'));
    }

}
