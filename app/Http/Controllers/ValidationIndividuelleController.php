<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use App\Models\Validationindividuelle;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ValidationIndividuelleController extends Controller
{
    public function update($id)
    {
        $individuelle   = Individuelle::findOrFail($id);
        $demandeur      = $individuelle->demandeur;
        $user           = $demandeur->user;

        $individuelle->update([
            'statut'                            => 'Validée',
        ]);

        $individuelle->save();

        $validated_by = new Validationindividuelle([
            'validated_id'       =>       Auth::user()->id,
            'action'             =>      'Validée',
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

        Alert::success('La demande de '.$individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'est validée');

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }
}
