<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy("created_at", "desc")->get();

        return view("localites.regions.index", compact("regions"));
    }


    public function create()
    {
        return view("localites.regions.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "region" => "required|string|unique:regions,nom,except,id",
            "sigle" => "required|string|unique:regions,sigle,except,id",
        ]);

        $region = Region::create([
            "nom" => $request->input("region"),
            "sigle" => $request->input("sigle"),
        ]);

        $region->save();

        $status = "Région " . $region->nom . " ajoutée avec succès";

        return  redirect()->route("regions.index")->with("status", $status);
    }

    public function show($id)
    {
        $region = Region::find($id);
        return view("localites.regions.show", compact("region"));
        
    }

    public function edit($id)
    {
        $region = Region::find($id);
        return view("localites.regions.update", compact("region"));
    }

    public function update(Request $request, $id)
    {
        $region = Region::find($id);
        $this->validate($request, [
            'nom' => ['required', 'string', 'max:25', Rule::unique(Region::class)->ignore($id)],
            "sigle" => ['required', 'string', 'max:25', Rule::unique(Region::class)->ignore($id)->whereNull('deleted_at')],
        ]);

        $region->update([
            'nom' => $request->nom,
            'sigle' => $request->sigle,
        ]);

        $mesage = 'La région ' . $region->nom . '  a été modifiée';

        return redirect()->route("regions.index")->with("status", $mesage);
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();
        $status = "Région " . $region->nom . " vient d'être supprimée";
        return redirect()->route("regions.index")->with('status', $status);
    }
}
