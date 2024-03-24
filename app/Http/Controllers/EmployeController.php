<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employee::orderBy("created_at", "desc")->get();
        return view("employes.index", compact("employes"));
    }

    public function create()
    {
        return view("employes.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "matricule" => "required",
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
