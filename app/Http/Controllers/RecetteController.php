<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recettes = DB::select(DB::raw('SELECT RECETTE.*, INVENTEUR.NVN_NOM, INVENTEUR.NVN_PRENOM FROM RECETTE, INVENTEUR WHERE RECETTE.ID_NVN = INVENTEUR.ID_NVN'));

        return view('recette.index', compact('recettes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temp = DB::select(DB::raw("SELECT * FROM INVENTEUR"));

        foreach($temp as $item)
        {
            $inventeurs[$item->ID_NVN] = $item->NVN_PRENOM . ' ' . $item->NVN_NOM;
        }

        return view('recette.create', compact('inventeurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_nvn = $request->all()['ID_NVN'];
        $rct_nom = $request->all()['RCT_NOM'];
        $rct_temp = $request->all()['RCT_TEMPERATURE'];
        DB::insert(DB::raw("INSERT INTO RECETTE(ID_NVN, RCT_NOM, RCT_VALIDEE, RCT_TEMPERATURE) VALUES ($id_nvn, '" . $rct_nom . "', 0, $rct_temp);"));
        $id = DB::select(DB::raw('SELECT RECETTE.ID_RCT FROM RECETTE ORDER BY ID_RCT DESC LIMIT 1;'))[0]->ID_RCT;
        return Redirect::route('recette.edit', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recette = DB::select(DB::raw("SELECT RECETTE.*, INVENTEUR.NVN_NOM, INVENTEUR.NVN_PRENOM FROM RECETTE, INVENTEUR WHERE RECETTE.ID_NVN = INVENTEUR.ID_NVN AND RECETTE.ID_RCT = $id"));
        $recette = $recette[0];
        $ingredients = DB::select(DB::raw("SELECT INGREDIENT.* FROM UTILISER, INGREDIENT WHERE UTILISER.ID_RCT = " . $recette->ID_RCT . " AND UTILISER.ID_NGR = INGREDIENT.ID_NGR"));
        return view('recette.show', compact('recette', 'ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recette = DB::select(DB::raw("SELECT * FROM RECETTE WHERE RECETTE.ID_RCT = $id"));
        $recette = $recette[0];
        $ingredients = DB::select(DB::raw("SELECT UTILISER.*, INGREDIENT.NGR_NOM FROM UTILISER, INGREDIENT WHERE UTILISER.ID_RCT = $id AND INGREDIENT.ID_NGR = UTILISER.ID_NGR"));
        $temp = DB::select(DB::raw("SELECT INGREDIENT.NGR_NOM, INGREDIENT.ID_NGR FROM INGREDIENT"));

        foreach($temp as $item)
        {
            $array[$item->ID_NGR] = $item->NGR_NOM;
        }

        return view('recette.edit', compact('recette', 'ingredients', 'array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::update(DB::raw("UPDATE RECETTE SET RCT_VALIDEE = 1 WHERE ID_RCT = $id"));
        return Redirect::route('recette.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete(DB::raw('
            DELETE FROM CONTIENT WHERE ID_PRD IN (SELECT ID_PRD FROM PRODUIT WHERE ID_RCT = '. $id .')'
        ));
        DB::delete(DB::raw('
            DELETE FROM COMPOSER WHERE ID_PRD IN (SELECT ID_PRD FROM PRODUIT WHERE ID_RCT = '. $id .')'
        ));
        DB::delete(DB::raw('
            DELETE FROM PRODUIT WHERE ID_RCT = '. $id
        ));
        DB::delete(DB::raw('
            DELETE FROM UTILISER WHERE ID_RCT = '. $id
        ));
        DB::delete(DB::raw('
            DELETE FROM RECETTE WHERE ID_RCT = '. $id
        ));

        return redirect(route('recette.index'));
    }
}
