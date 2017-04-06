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

        $tmp = [];
        $diluants = DB::select(DB::raw('
            SELECT ID_DLN, DLN_NOM FROM diluant
        '));
        $tmp[null] = 'Pas de diluant';
        foreach ($diluants as $k => $diluant)
            $tmp[$diluant->ID_DLN] = $diluant->DLN_NOM;
        $diluants = $tmp;

        $tmp = [];
        $recipients = DB::select(DB::raw('
            SELECT ID_RCP, RCP_NOM FROM recipient
        '));
        $tmp[null] = 'Pas de récipient';
        foreach ($recipients as $k => $recipient)
            $tmp[$recipient->ID_RCP] = $recipient->RCP_NOM;
        $recipients = $tmp;

        return view('produit.create', compact('recettes', 'diluants', 'recipients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $values = $request->all();
        $isPotion = $values['ID_DLN'] == null ? '0' : '1';
        $values['ID_DLN'] = $values['ID_DLN'] == null ? 'NULL': $values['ID_DLN'];

        DB::insert(DB::raw("
            INSERT INTO produit(ID_RCT, PRD_NOM, ID_DLN, PRD_PRIX, PRD_IS_POTION) VALUES(
              ". $values['ID_RCT'] .", '". $values['PRD_NOM'] ."', ". $values['ID_DLN'] .", ". $values['PRD_PRIX'] .", ". $isPotion ."
            )
        "));

        $idProduit = DB::getPdo()->lastInsertId();

        if($values['ID_DLN'] != "NULL") {
            DB::insert(DB::raw('
                INSERT INTO contient(ID_RCP, ID_PRD) VALUES('. $values['ID_RCP'] .', '. $idProduit .')
            '));
        }

        return redirect(route('produit.show', $idProduit));
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
        if($produit->ID_DLN != null) {
            $produit->diluant = DB::select(DB::raw('
                SELECT DLN_NOM FROM diluant
                WHERE ID_DLN = '. $produit->ID_DLN
            ));
            $produit->diluant = $produit->diluant[0];
        }
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
        $produit = DB::select(DB::raw('SELECT * FROM produit WHERE produit.ID_PRD = '. $id))[0];

        $recettes = DB::select(DB::raw('
            SELECT ID_RCT, RCT_NOM FROM recette
        '));
        foreach ($recettes as $k => $recette)
            $tmp[$recette->ID_RCT] = $recette->RCT_NOM;
        $recettes = $tmp;

        $tmp = [];
        $diluants = DB::select(DB::raw('
            SELECT ID_DLN, DLN_NOM FROM diluant
        '));
        $tmp[null] = 'Pas de diluant';
        foreach ($diluants as $k => $diluant)
            $tmp[$diluant->ID_DLN] = $diluant->DLN_NOM;
        $diluants = $tmp;

        $tmp = [];
        $recipients = DB::select(DB::raw('
            SELECT ID_RCP, RCP_NOM FROM recipient
        '));
        $tmp[null] = 'Pas de récipient';
        foreach ($recipients as $k => $recipient)
            $tmp[$recipient->ID_RCP] = $recipient->RCP_NOM;
        $recipients = $tmp;

        $idrcp = DB::select(DB::raw('SELECT ID_RCP FROM contient WHERE ID_PRD = '. $id))[0]->ID_RCP;

        return view('produit.edit', compact('produit', 'diluants', 'recettes', 'recipients', 'idrcp'));
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
