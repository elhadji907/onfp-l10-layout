<?php

namespace App\Http\Controllers;

use App\Models\Operateurmodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ValidationmoduleController extends Controller
{
    public function update($id)
    {
        $operateurmodule   = Operateurmodule::findOrFail($id);

        $operateurmodule->update([
            'statut'             => 'Validé',
            'details'            =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $operateurmodule->save();

        Alert::success('Effectué !', 'le module ' . $operateurmodule->module . ' a été validé');

        return redirect()->back();
    }
    
    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            "motif" => "required|string",
        ]);

        $operateurmodule   = Operateurmodule::findOrFail($id);

        $operateurmodule->update([
            'statut'                => 'Rejeté',
            'details'               =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $operateurmodule->save();

        Alert::success('Effectué !', 'le module ' . $operateurmodule->module . ' a été rejeté');

        return redirect()->back();
    }
}
