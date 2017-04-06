<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UtiliserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detruire($id, $ing)
    {
        DB::select(DB::raw("CALL delIngredientFromRecipe($id, $ing)"));

        return Redirect::route('recette.show', $id);
    }

    public function save()
    {
        $f = fopen("backup.sql", "w+");

        $recettes = DB::select(DB::raw('SELECT * FROM RECETTE'));
        $inventeurs = DB::select(DB::raw('SELECT * FROM INVENTEUR'));
        $produits = DB::select(DB::raw('SELECT * FROM PRODUIT'));
        $diluants = DB::select(DB::raw('SELECT * FROM DILUANT'));
        $utiliser = DB::select(DB::raw('SELECT * FROM UTILISER'));
        $ingredients = DB::select(DB::raw('SELECT * FROM INGREDIENT WHERE ID_NGR IN (SELECT ID_NGR FROM UTILISER) OR ID_NGR IN (SELECT ID_NGR FROM STOCK) OR ID_NGR IN (SELECT ID_NGR FROM ACHETER)'));
        $commandes = DB::select(DB::raw('SELECT * FROM COMMANDE WHERE CMM_ETAT = 0'));
        $composer = DB::select(DB::raw('SELECT * FROM COMPOSER WHERE ID_CMM IN (SELECT ID_CMM FROM COMMANDE WHERE CMM_ETAT = 0)'));
        $clients = DB::select(DB::raw('SELECT * FROM CLIENT WHERE ID_CLN IN (SELECT ID_CLN FROM COMMANDE WHERE CMM_ETAT = 0)'));
        $acheter = DB::select(DB::raw('SELECT * FROM ACHETER WHERE ID_CMM IN (SELECT ID_CMM FROM COMMANDE WHERE CMM_ETAT = 0)'));
        foreach($inventeurs as $inventeur)
        {
            fwrite($f, "INSERT INTO INVENTEUR(ID_NVN, NVN_NOM, NVN_PRENOM) VALUES (" . $inventeur->ID_NVN . ", '" . str_replace("'", '\'\'', $inventeur->NVN_NOM) . "', '" . str_replace("'", '\'\'', $inventeur->NVN_PRENOM) . "');\n");
        }
        foreach($recettes as $recette)
        {
            fwrite($f, "INSERT INTO RECETTE(ID_RCT, ID_NVN, RCT_NOM, RCT_VALIDEE, RCT_TEMPERATURE) VALUES (". $recette->ID_RCT . ", " . $recette->ID_NVN . ", '" . str_replace("'", '\'\'', $recette->RCT_NOM) . "', " . $recette->RCT_VALIDEE . ", " . $recette->RCT_TEMPERATURE . ");\n");
        }
        foreach($diluants as $diluant)
        {
            fwrite($f, "INSERT INTO DILUANT(ID_DLN, DLN_NOM, DLN_PRIX) VALUES (" . $diluant->ID_DLN . ", '" . str_replace("'", '\'\'', $diluant->DLN_NOM) . "', " . $diluant->DLN_PRIX . ");\n");
        }
        foreach($ingredients as $ingredient)
        {
            fwrite($f, "INSERT INTO INGREDIENT(ID_NGR, NGR_NOM, NGR_PRIX) VALUES (" . $ingredient->ID_NGR . ", '" . str_replace("'", '\'\'', $ingredient->NGR_NOM) . "', " . $ingredient->NGR_PRIX . ");\n");
        }
        foreach($utiliser as $ingredient)
        {
            fwrite($f, "INSERT INTO UTILISER(ID_RCT, ID_NGR, FRAICHEUR_MIN, FRAICHEUR_MAX, QUANTITE) VALUES (" . $ingredient->ID_RCT . ", " . $ingredient->ID_NGR . ", " . $ingredient->FRAICHEUR_MIN . ", " . $ingredient->FRAICHEUR_MAX . ", " . $ingredient->QUANTITE . ");\n");
        }
        foreach($produits as $produit)
        {
            fwrite($f, "INSERT INTO PRODUIT(ID_PRD, ID_RCT, ID_DLN, PRD_NOM, PRD_PRIX, PRD_IS_POTION) VALUES (" . $produit->ID_PRD . ", " . $produit->ID_RCT . ", " . $produit->ID_DLN . ", '" . str_replace("'", '\'\'', $produit->PRD_NOM) . "', " . $produit->PRD_PRIX . ", " . $produit->PRD_IS_POTION . ");\n");
        }
        foreach($clients as $client)
        {
            fwrite($f, "INSERT INTO CLIENT(ID_CLN, CLN_NOM, CLN_PRENOM) VALUES (" . $client->ID_CLN . ", '" . str_replace("'", '\'\'', $client->CLN_NOM) . "', '" . str_replace("'", '\'\'', $client->CLN_PRENOM) . "');\n");
        }
        foreach($commandes as $commande)
        {
            fwrite($f, "INSERT INTO COMMANDE(ID_CMM, ID_CLN, CMM_ETAT, CMM_DATE) VALUES (" . $commande->ID_CMM . ", " . $commande->ID_CLN . ", " . $commande->CMM_ETAT . ", '" . $commande->CMM_DATE . "');\n");
        }
        foreach($composer as $produit)
        {
            fwrite($f, "INSERT INTO COMMANDE(ID_CMM, ID_PRD, QUANTITE) VALUES (" . $produit->ID_CMM . ", " . $produit->ID_PRD . ", " . $produit->QUANTITE . ");\n");
        }
        foreach($acheter as $ingredient)
        {
            fwrite($f, "INSERT INTO ACHETER(ID_CMM, ID_NGR, QUANTITE) VALUES (" . $ingredient->ID_CMM . ", " . $ingredient->ID_NGR . ", " . $ingredient->QUANTITE . ");\n");
        }

        fclose($f);
        return redirect('/backup.sql');
    }

    public function update(Request $request, $id)
    {
        for($i = 1; $i<count($request->all())/4 - 1; $i++) {
            $id_ngr = $request->all()['ID_NGR' . $i];
            $fraichMin = $request->all()['FRAICHEUR_MIN' . $i];
            $fraichMax = $request->all()['FRAICHEUR_MAX' . $i];
            $quantite = $request->all()['QUANTITE' . $i];
            DB::insert(DB::raw("INSERT INTO UTILISER(ID_RCT, ID_NGR, FRAICHEUR_MIN, FRAICHEUR_MAX, QUANTITE)
                            VALUES ($id, $id_ngr, $fraichMin, $fraichMax, $quantite)
                            ON DUPLICATE KEY UPDATE
                            FRAICHEUR_MIN = $fraichMin,
                            FRAICHEUR_MAX = $fraichMax,
                            QUANTITE = $quantite;"));
        }
        if($request->all()['ID_NGR'] != null && $request->all()['FRAICHEUR_MIN'] != null && $request->all()['FRAICHEUR_MAX'] != null && $request->all()['QUANTITE'] != null)
        {
            $id_ngr = $request->all()['ID_NGR'];
            $fraichMin = $request->all()['FRAICHEUR_MIN'];
            $fraichMax = $request->all()['FRAICHEUR_MAX'];
            $quantite = $request->all()['QUANTITE'];
            DB::insert(DB::raw("INSERT INTO UTILISER(ID_RCT, ID_NGR, FRAICHEUR_MIN, FRAICHEUR_MAX, QUANTITE)
                            VALUES ($id, $id_ngr, $fraichMin, $fraichMax, $quantite)
                            ON DUPLICATE KEY UPDATE
                            FRAICHEUR_MIN = $fraichMin,
                            FRAICHEUR_MAX = $fraichMax,
                            QUANTITE = $quantite;"));
        }
        return Redirect::route('recette.show', $id);
    }
}
