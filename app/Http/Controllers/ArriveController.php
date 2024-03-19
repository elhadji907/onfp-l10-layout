<?php

namespace App\Http\Controllers;

use App\Models\Arrive;
use App\Models\Courrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArriveController extends Controller
{
    public function index()
    {
        $arrives = Arrive::orderBy('created_at', 'desc')->get();
        return view("courriers.arrives.index", compact("arrives"));
    }

    public function create()
    {
        return view("courriers.arrives.create");
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "date_arrivee"          => ["required", "date"],
                "date_correspondance"   => ["required", "date"],
                "numero_correspondance" => ["required", "string", "min:4", "max:6", "unique:arrives,numero,Null,id,deleted_at,NULL"],
                "annee"                 => ["required", "string"],
                "expediteur"            => ["required", "string"],
                "objet"                 => ["required", "string"],
            ]
        );

        $courrier = new Courrier([
            'numero'             =>      $request->input('numero_correspondance'),
            'objet'              =>      $request->input('objet'),
            'observation'        =>      $request->input('observation'),
            'expediteur'         =>      $request->input('expediteur'),
            'date_recep'         =>      $request->input('date_arrivee'),
            'date_cores'         =>      $request->input('date_correspondance'),
            'users_id'           =>      Auth::user()->id,
        ]);

        $courrier->save();

        $arrive = new Arrive([
            'numero'             =>      $request->input('numero_correspondance'),
            'courriers_id'       =>      $courrier->id
        ]);

        $arrive->save();

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $arrive = Arrive::findOrFail($id);
        dd($arrive);
    }

    public function update(Request $request, $id)
    {
        $arrive = Arrive::findOrFail($id);
        dd($arrive);
    }

    public function destroy($arriveId)
    {
        $arrive = Arrive::findOrFail($arriveId);
        $arrive->courrier()->delete();
        $arrive->delete();
        $status = "Supprimer avec succès";
        return redirect()->back()->with("danger", $status);
    }
}
