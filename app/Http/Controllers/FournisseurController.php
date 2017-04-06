<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{

    private $sqls = [
        'selectAll' => 'SELECT * FROM fournisseur'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $fournisseurs = DB::select(DB::raw($this->sqls['selectAll']));

        return view('fournisseur.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('fournisseur.create');
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
            INSERT INTO fournisseur(FRN_NOM) VALUES("'. $values['FRN_NOM'] .'")
        '));

        return redirect(route('fournisseur.show', DB::getPdo()->lastInsertId()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $fournisseur = DB::select(DB::raw('SELECT * FROM fournisseur WHERE ID_FRN = '. $id));
        $fournisseur = $fournisseur[0];
        $fournisseur->ingredients = DB::select(DB::raw('
            SELECT * FROM stock
            INNER JOIN ingredient ON stock.ID_NGR = ingredient.ID_NGR
            WHERE ID_FRN = '. $fournisseur->ID_FRN
        ));

        return view('fournisseur.show', compact('fournisseur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $fournisseur = DB::select(DB::raw('
            SELECT * FROM fournisseur
            WHERE ID_FRN = '. $id
        ));
        $fournisseur = $fournisseur[0];

        return view('fournisseur.edit', compact('fournisseur'));
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
            UPDATE fournisseur SET FRN_NOM = "'. $values['FRN_NOM'] .'" WHERE ID_FRN = '. $id
        ));

        return redirect(route('fournisseur.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete(DB::raw('DELETE FROM stock WHERE ID_FRN = '. $id));
        DB::delete(DB::raw('DELETE FROM fournisseur WHERE ID_FRN = '. $id));

        return redirect(route('fournisseur.index'));
    }
}
