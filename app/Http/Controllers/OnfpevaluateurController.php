<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Module;
use App\Models\Onfpevaluateur;
use App\Models\Operateur;
use App\Models\Region;
use App\Models\TypesFormation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class OnfpevaluateurController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin|Ingenieur']);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }
    public function index()
    {
        $onfpevaluateurs = Onfpevaluateur::orderBy("created_at", "desc")->get();

        return view("onfpevaluateurs.index", compact("onfpevaluateurs"));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "matricule"         => ["nullable", "string", Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "name"              => ["required", "string", Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "initiale"          => ["required", "string", Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fonction"          => [Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email"             => ["required", "string", Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone"         => ["required", "string", Rule::unique('onfpevaluateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
        ]);

        $onfpevaluateur = Onfpevaluateur::create([
            "matricule"     => $request->input("matricule"),
            "name"          => $request->input("name"),
            "initiale"      => $request->input("initiale"),
            "fonction"      => $request->input("fonction"),
            "specialite"    => $request->input("specialite"),
            "email"         => $request->input("email"),
            "telephone"     => $request->input("telephone"),
        ]);

        $onfpevaluateur->save();

        Alert::success('Félicitation !', 'Enregistrement effectué');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $onfpevaluateur = Onfpevaluateur::find($id);

        $this->validate($request, [
            'matricule'     => ['nullable', 'string', 'max:25', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
            "name"          => ['required', 'string', 'max:25', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
            "initiale"      => ['required', 'string', 'max:25', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
            "fonction"      => ['required', 'string', 'max:250', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
            "email"         => ['required', 'string', 'max:250', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
            "telephone"     => ['required', 'string', 'max:250', Rule::unique(Onfpevaluateur::class)->ignore($id)->whereNull('deleted_at')],
        ]);

        $onfpevaluateur->update([
            "matricule"     => $request->input("matricule"),
            "name"          => $request->input("name"),
            "initiale"      => $request->input("initiale"),
            "fonction"      => $request->input("fonction"),
            "specialite"    => $request->input("specialite"),
            "email"         => $request->input("email"),
            "telephone"     => $request->input("telephone"),
        ]);

        $onfpevaluateur->save();

        Alert::success('Fait ! ', 'modification effectuée');

        return redirect()->back();
    }

    public function show($id)
    {
        $onfpevaluateur     = Onfpevaluateur::findOrFail($id);
        $modules            = Module::orderBy("created_at", "desc")->get();
        $departements       = Departement::orderBy("created_at", "desc")->get();
        $regions            = Region::orderBy("created_at", "desc")->get();
        $operateurs         = Operateur::orderBy("created_at", "desc")->get();
        $types_formations   = TypesFormation::orderBy("created_at", "desc")->get();
        $onfpevaluateurs         = Onfpevaluateur::orderBy("created_at", "desc")->get();
        return view('onfpevaluateurs.show', compact('onfpevaluateur', 'departements', 'modules', 'regions', 'operateurs', 'types_formations', 'onfpevaluateurs'));
    }

    public function destroy($id)
    {
        $onfpevaluateur = Onfpevaluateur::find($id);
        $onfpevaluateur->delete();

        Alert::success('Fait !', 'Suppression effectuée');

        return redirect()->back();
    }
}
