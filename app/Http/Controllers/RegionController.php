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
        $regions = Region::orderBy("created_at", "desc")->get();
        return view("localites.regions.create", compact("regions"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "region" => "required|string|unique:regions,nom,except,id",
            "code_region" => "required|string|unique:regions,sigle,except,id",
        ]);

        $region = Region::create([
            "nom" => $request->input("region"),
            "sigle" => $request->input("code_region"),
        ]);

        $region->save();

        $status = "Région " . $region->nom . " ajoutée avec succès";

        return  redirect()->route("regions.index", compact("region"))->with("status", $status);
    }

    public function show($id)
    {
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
            "region" => "required|string",
            "code_region" => "required|string",
        ]);

        $region->update([
            'nom' => $request->region,
            'sigle' => $request->code_region,
        ]);

        $mesage = 'La région ' . $region->nom . '  a été modifiée';

        return redirect()->route("regions.index")->with("status", $mesage);
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();
        $status = "Région " . $region->nom . " vient d'être supprimé";
        return redirect()->route("regions.index")->with('status', $status);
    }
}
