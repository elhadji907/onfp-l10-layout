<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view("role-permission.role.index", compact('roles'));
    }


    public function create()
    {
        return view("role-permission.role.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => ["required", "string", "unique:roles,name"]
        ]);
        Role::create([
            "name" => $request->name
        ]);
        return redirect()->route("roles.create")->with("status", "Role créé avec succès");
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view("role-permission.role.update", compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', Rule::unique(Role::class)->ignore($id)]
        ]);

        Role::find($id)->update([
            'name' => $request->name
        ]);

        $roles = Role::get();
        $mesage = 'L e role a été modifiée';
        return redirect()->route("roles.index", compact('roles'))->with("status", $mesage);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        $mesage = 'Le role ' . $role->name . ' a été supprimé';
        return redirect()->back()->with("danger", $mesage);
    }
}
