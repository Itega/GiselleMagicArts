<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{

    protected $sqls = [
        'selectAll' => 'SELECT * FROM produit'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $produits = DB::select(DB::raw($this->sqls['selectAll']));

        return view('produit.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $recettes = DB::select(DB::raw('
            SELECT ID_RCT, RCT_NOM FROM recette
        '));
        foreach ($recettes as $k => $recette)
            $tmp[$recette->ID_RCT] = $recette->RCT_NOM;
        $recettes = $tmp;

        $diluants = DB::select(DB::raw('
            SELECT ID_DLN, DLN_NOM FROM diluant
        '));
        $tmp[null] = 'Pas de diluant';
        foreach ($diluants as $k => $diluant)
            $tmp[$diluant->ID_DLN] = $diluant->DLN_NOM;
        $diluants = $tmp;

        return view('produit.create', compact('recettes', 'diluants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $produit = DB::select(DB::raw('
            SELECT * FROM produit
            WHERE ID_PRD = '. $id
        ));
        $produit = $produit[0];
        $produit->diluant = DB::select(DB::raw('
            SELECT DLN_NOM FROM diluant
            WHERE ID_DLN = '. $produit->ID_DLN
        ));
        $produit->diluant = $produit->diluant[0];
        $produit->recette = DB::select(DB::raw('
            SELECT RCT_NOM, RCT_TEMPERATURE FROM recette
            WHERE ID_RCT = '. $produit->ID_RCT .'
            AND RCT_VALIDEE = 1
        '));
        $produit->recette = $produit->recette[0];

        return view('produit.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
    }
}
