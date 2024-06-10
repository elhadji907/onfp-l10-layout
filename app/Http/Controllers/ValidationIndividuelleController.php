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

        $individuelle->update([
            'statut'             => 'Validée',
            'validated_by'       =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $individuelle->save();

        $validated_by = new Validationindividuelle([
            'validated_id'       =>       Auth::user()->id,
            'action'             =>      'Validée',
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

        Alert::success('La demande de ' . $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'est validée');

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }

    public function destroy($id)
    {
        $individuelle   = Individuelle::findOrFail($id);

        $individuelle->update([
            'statut'             => 'Rejetée',
            'canceled_by'        =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $individuelle->save();

        $validated_by = new Validationindividuelle([
            'validated_id'       =>       Auth::user()->id,
            'action'             =>      'Rejetée',
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

        Alert::success('La demande de ' . $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'est rejetée');

        return redirect()->back();
    }

}
