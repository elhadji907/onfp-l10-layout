<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return view("role-permission.permission.index", compact('permissions'));
    }


    public function create()
    {
        return view("role-permission.permission.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => ["required", "string", "unique:permissions,name"]
        ]);
        Permission::create([
            "name" => $request->name
        ]);
        return redirect()->route("permissions.create")->with("status", "Permission créée avec succès");
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view("role-permission.permission.update", compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', Rule::unique(Permission::class)->ignore($id)]
        ]);

        Permission::find($id)->update([
            'name' => $request->name
        ]);

        $permissions = Permission::get();
        $mesage = 'La permission a été modifiée';
        return redirect()->route("permissions.index", compact('permissions'))->with("status", $mesage);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        $mesage = 'La permission ' . $permission->name . ' a été supprimée';
        return redirect()->back()->with("danger", $mesage);
    }
}
