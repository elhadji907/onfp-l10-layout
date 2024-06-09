<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ValidationIndividuelleController extends Controller
{
    public function update(Request $request, $id)
    {
        $individuelle   = Individuelle::findOrFail($id);
        $demandeur      = $individuelle->demandeur;
        $user           = $demandeur->user;

        $individuelle->update([
            'statut'                            => 'Validée',
        ]);

        $individuelle->save();

        Alert::success('Validée ! ', 'Demande acceptée');

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }
}
