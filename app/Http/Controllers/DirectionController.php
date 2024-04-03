<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DirectionController extends Controller
{
    public function index()
    {
        $directions = Direction::orderBy("created_at", "desc")->get();
        return view("directions.index", compact("directions"));
    }

    public function create()
    {
        $employe = Employee::orderBy("created_at", "desc")->get();
        return view('directions.create', compact('employe'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            "direction"         => "required|string|unique:directions,name,except,id",
            "sigle"             => "required|string|unique:directions,sigle,except,id",
            "type"              => "required|string",
        ]);

        $direction = Direction::create([
            "name" => $request->input("direction"),
            "sigle" => $request->input("sigle"),
            "type" => $request->input("type"),
            "chef_id" => $request->input("employe"),
        ]);

        $direction->save();

        $status = $direction->name . " ajouté(e) avec succès";

        return  redirect()->route("directions.index")->with("status", $status);
    }

    public function edit($id)
    {
        $direction = Direction::find($id);
        $employe = Employee::orderBy("created_at", "desc")->get();
        $chef = Employee::findOrFail($direction->chef_id);
        $chef_name = $chef->matricule . ' ' . $chef->user->firstname . ' ' . $chef->user->name;
        return view("directions.update", compact("direction", "employe", "chef_name", "chef"));
    }
    public function update(Request $request, $id)
    {
        $direction = Direction::find($id);
        $this->validate($request, [
            'name'      => ['required', 'string', 'max:255', Rule::unique(Direction::class)->ignore($id)],
            'sigle'     => ['required', 'string', 'max:10', Rule::unique(Direction::class)->ignore($id)],
            "type"      => ['required', 'string'],
        ]);

        $direction->update([
            'name' => $request->input("name"),
            'sigle' => $request->input("sigle"),
            'type' => $request->input("type"),
            'chef_id' => $request->input("employe"),
        ]);

        $mesage = $direction->name . '  a été modifiée';

        return redirect()->route("directions.index")->with("status", $mesage);
    }
    public function show($id)
    {
        $direction = Direction::find($id);
        $directions = Direction::orderBy("created_at", "desc")->get();
        return view("directions.show", compact("direction", 'directions'));
    }
    public function destroy($id)
    {
        $direction = Direction::find($id);
        $direction->delete();
        $status = $direction->name . " vient d'être supprimé";
        return redirect()->route("directions.index")->with('status', $status);
    }
}
