<?php

namespace App\Http\Controllers;

use App\Models\Operateureference;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class OperateureferenceController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "organisme"                =>      ["required", "string"],
            "contact"                  =>      ["required", "string"],
            "periode"                  =>      ["required", "string"],
            "description"              =>      ["required", "string"],
        ]);


        $operateureference = Operateureference::create([
            "organisme"        => $request->input("organisme"),
            "contact"          => $request->input("contact"),
            "periode"          => $request->input("periode"),
            "description"      => $request->input("description"),
            "operateurs_id"    => $request->input("operateur"),
        ]);

        $operateureference->save();

        Alert::success('Félicitation !', 'Enregistrement effectué');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "organisme"                =>      ["required", "string"],
            "contact"                  =>      ["required", "string"],
            "periode"                  =>      ["required", "string"],
            "description"              =>      ["required", "string"],
        ]);

        $operateureference = Operateureference::findOrFail($id);

        $operateureference->update([
            "organisme"        => $request->input("organisme"),
            "contact"          => $request->input("contact"),
            "periode"          => $request->input("periode"),
            "description"      => $request->input("description"),
            "operateurs_id"    => $request->input("operateur"),
        ]);

        $operateureference->save();

        Alert::success('Félicitation !', 'Modification effectuée');

        return redirect()->back();
    }

    public function show($id)
    {
        $operateureference = Operateureference::find($id);
        return view('operateureferences.show', compact('operateureference'));
    }

    public function destroy($id)
    {
        $operateureference = Operateureference::find($id);
        $operateureference->delete();

        Alert::success("Fait ! ", 'la référence a été supprimée avec succès');
        return redirect()->back();
    }
}
