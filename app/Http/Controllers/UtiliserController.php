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

    public function inserer($id_)
    {
        foreach($id_ as $id)
        {
            DB::select(DB::raw("addIngredient($id->id, $id->ing, $id->fraicheurMin, $id->fraicheurMax)"));
        }


        return Redirect::route('recette.show', $id);
    }
}
