<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employee::orderBy("created_at", "desc")->get();
        return view("employes.index", compact("employes"));
    }

    public function create()
    {
        $directions = Direction::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $fonctions = Fonction::orderBy('created_at', 'desc')->get();
        return view("employes.create", compact('directions', 'categories', 'fonctions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "matricule" => ['nullable', 'string', 'min:8', 'max:8'],
            'firstname' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:25'],
            'image' => ['image', 'max:255', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'telephone' => ['required', 'string', 'max:25', 'min:9'],
            'adresse' => ['required', 'string', 'max:255'],
            'civilite' => ['required', 'string', 'max:5'],
            'cin' => ['required', 'string', 'min:13', 'max:15'],
            'date_naissance' => ['required', 'date'],
            'lieu_naissance' => ['string', 'required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'date_embauche' => ['required', 'date'],
            'categorie' => ['required', 'string'],
            'fonction' => ['required', 'string'],
            'direction' => ['required', 'string'],
        ]);
    }

    public function edit($id)
    {
        $employe = Employee::find($id);
        dd($employe);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "matricule" => "required",
        ]);
    }

    public function show($id)
    {
        $employe = Employee::findOrFail($id);
        dd($employe);
    }

    public function destroy($id)
    {
        $employe = Employee::findOrFail($id);
        $employe->user->delete();
        $employe->delete();
        $mesage = $employe->user->firstname . ' ' . $employe->user->name . ' a été supprimé(e)';
        return redirect()->back()->with("danger", $mesage);
    }
}
