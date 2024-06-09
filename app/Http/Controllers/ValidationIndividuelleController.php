<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;

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

        return redirect()->back()->with("status", "Demande validée");
    }
}
