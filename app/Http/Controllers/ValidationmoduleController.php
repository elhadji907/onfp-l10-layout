<?php

namespace App\Http\Controllers;

use App\Models\Moduleoperateurstatut;
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
            'statut'             => 'agréer',
            'details'            =>  Auth::user()->firstname . ' ' . Auth::user()->name,
        ]);

        $operateurmodule->save();
        
        $moduleoperateurstatut = new Moduleoperateurstatut([
            'statut'                =>  "agréer",
            'operateurmodules_id'   =>  $operateurmodule->id,

        ]);

        $moduleoperateurstatut->save();

        Alert::success('Effectué !', 'le module ' . $operateurmodule->module . ' a été agréé');

        return redirect()->back();
    }
    
    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            "motif" => "required|string",
        ]);

        $operateurmodule   = Operateurmodule::findOrFail($id);

        $operateurmodule->update([
            'statut'                => 'rejeter',
            'details'               =>  Auth::user()->id
        ]);

        $operateurmodule->save();

        $moduleoperateurstatut = new Moduleoperateurstatut([
            'statut'                =>  "rejeter",
            'operateurmodules_id'   =>  $operateurmodule->id,

        ]);

        $moduleoperateurstatut->save();

        Alert::success('Effectué !', 'le module ' . $operateurmodule->module . ' a été rejeté');

        return redirect()->back();
    }
}
