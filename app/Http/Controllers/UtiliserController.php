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

        $recettes = DB::select(DB::raw('SELECT RECETTE, INVENTEUR.NVN_NOM, INVENTEUR.NVN_PRENOM FROM RECETTE, INVENTEUR WHERE RECETTE.ID_NVN = INVENTEUR.ID_NVN'));
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
