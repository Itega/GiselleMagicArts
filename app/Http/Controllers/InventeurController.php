<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventeurController extends Controller
{

    private $sqls = [
        'selectAll' => 'SELECT * FROM inventeur'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $inventeurs = DB::select(DB::raw($this->sqls['selectAll']));

        return view('inventeur.index', compact('inventeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('inventeur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $values = $request->all();

        DB::insert(DB::raw('
            INSERT INTO inventeur(NVN_NOM, NVN_PRENOM) VALUES ("'. $values['NVN_NOM'] .'", "'. $values['NVN_PRENOM'] .'")
        '));

        return redirect(route('inventeur.show', DB::getPdo()->lastInsertId()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $inventeur = DB::select(DB::raw('SELECT * FROM inventeur WHERE ID_NVN = '. $id));
        $inventeur[0]->recettes = DB::select(DB::raw('SELECT * FROM recette WHERE ID_NVN = '. $id));

        $inventeur = $inventeur[0];

        return view('inventeur.show', compact('inventeur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $inventeur = DB::select(DB::raw('
            SELECT * FROM inventeur WHERE ID_NVN = '. $id
        ));
        $inventeur = $inventeur[0];

        return view('inventeur.edit', compact('inventeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $values = $request->all();

        DB::update(DB::raw('
            UPDATE inventeur SET NVN_NOM = "'. $values['NVN_NOM'] .'", NVN_PRENOM = "'. $values['NVN_PRENOM'] .'" WHERE ID_NVN = '. $id
        ));

        return redirect(route('inventeur.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete(DB::raw('
            DELETE FROM contient WHERE ID_PRD IN (SELECT ID_PRD FROM produit WHERE ID_RCT IN (SELECT ID_RCT FROM inventeur WHERE ID_NVN = '. $id .'))'
        ));
        DB::delete(DB::raw('
            DELETE FROM composer WHERE ID_PRD IN (SELECT ID_PRD FROM produit WHERE ID_RCT IN (SELECT ID_RCT FROM inventeur WHERE ID_NVN = '. $id .'))'
        ));
        DB::delete(DB::raw('
            DELETE FROM produit WHERE ID_RCT IN (SELECT ID_RCT FROM inventeur WHERE ID_NVN = '. $id .')'
        ));
        DB::delete(DB::raw('
            DELETE FROM utiliser WHERE ID_RCT IN (SELECT ID_RCT FROM inventeur WHERE ID_NVN = '. $id .')'
        ));
        DB::delete(DB::raw('
            DELETE FROM recette WHERE ID_NVN = '. $id
        ));
        DB::delete(DB::raw('
            DELETE FROM inventeur WHERE ID_NVN = '. $id
        ));

        return redirect(route('inventeur.index'));
    }
}
