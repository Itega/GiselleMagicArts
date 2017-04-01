<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    private $sqls = [
        'selectAll' => 'SELECT * FROM ingredient'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ingredients = DB::select(DB::raw($this->sqls['selectAll']));
        
        return view('ingredient.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('ingredient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        DB::insert(DB::raw('
            INSERT INTO ingredient(NGR_NOM, NGR_PRIX) VALUES ("'. htmlentities($request->all()['NRG_NOM']) .'", '. htmlentities($request->all()['NRG_PRIX']) .')
        '));

        return redirect(route('ingredient.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::delete(DB::raw('DELETE FROM utiliser WHERE ID_NGR = '. $id));
        DB::delete(DB::raw('DELETE FROM stock WHERE ID_NGR = '. $id));
        DB::delete(DB::raw('DELETE FROM ingredient WHERE ID_NGR = '. $id));

        return redirect(route('ingredient.index'));
    }
}
