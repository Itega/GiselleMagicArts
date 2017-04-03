<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $ingredients = DB::select(DB::raw("SELECT INGREDIENT.* FROM UTILISER, INGREDIENT WHERE UTILISER.ID_RCT = " . $recette[0]->ID_RCT . " AND UTILISER.ID_NGR = INGREDIENT.ID_NGR"));

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
        $ingredients = DB::select(DB::raw("SELECT UTILISER.*, INGREDIENT.NGR_NOM FROM UTILISER, INGREDIENT WHERE UTILISER.ID_RCT = $id AND INGREDIENT.ID_NGR = UTILISER.ID_NGR"));

        return view('recette.edit', compact('recette', 'ingredients'));
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
        //
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
