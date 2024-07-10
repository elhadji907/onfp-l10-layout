<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use App\Models\Validationindividuelle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ValidationIndividuelleController extends Controller
{
    public function update($id)
    {
        $individuelle   = Individuelle::findOrFail($id);

        $individuelle->update([
            'statut'             => 'accepter',
            'validated_by'       =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $individuelle->save();

        $validated_by = new Validationindividuelle([
            'validated_id'       =>       Auth::user()->id,
            'action'             =>      'accepter',
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

        Alert::success('La demande de ' . $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'est acceptée');

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            "motif" => "required|string",
        ]);

        $individuelle   = Individuelle::findOrFail($id);

        $individuelle->update([
            'statut'                => 'rejeter',
            'canceled_by'           =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $individuelle->save();

        $validated_by = new Validationindividuelle([
            'validated_id'       =>      Auth::user()->id,
            'action'             =>      'rejeter',
            'motif'              =>      $request->input('motif'),
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

        Alert::success('La demande de ' . $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'est rejetée');

        return redirect()->back();
    }

}
