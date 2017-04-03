<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RecetteController extends Controller
{

    private $sql = [
        'selectAll'     => 'SELECT * FROM RECETTE',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recettes = DB::select(DB::raw($this->sql['selectAll']));

        return view('recette.index', compact('recettes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recette = DB::select(DB::raw("SELECT * FROM RECETTE WHERE RECETTE.ID_RCT = $id"));
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
        for($i = 1; $i<count($request->all())/4 - 1; $i++) {
            $id_ngr = $request->all()['ID_NGR' . $i];
            $fraichMin = $request->all()['FRAICHEUR_MIN' . $i];
            $fraichMax = $request->all()['FRAICHEUR_MAX' . $i];
            $quantite = $request->all()['QUANTITE' . $i];
            DB::select(DB::raw("INSERT INTO UTILISER(ID_RCT, ID_NGR, FRAICHEUR_MIN, FRAICHEUR_MAX, QUANTITE)
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
            DB::select(DB::raw("INSERT INTO UTILISER(ID_RCT, ID_NGR, FRAICHEUR_MIN, FRAICHEUR_MAX, QUANTITE)
                            VALUES ($id, $id_ngr, $fraichMin, $fraichMax, $quantite)
                            ON DUPLICATE KEY UPDATE
                            FRAICHEUR_MIN = $fraichMin,
                            FRAICHEUR_MAX = $fraichMax,
                            QUANTITE = $quantite;"));
        }
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
        //
    }
}
