<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("permission:role-view", ["only"=> ["index"]]);
        $this->middleware("permission:role-create", ["only"=> ["create","store"]]);
        $this->middleware("permission:role-update", ["only"=> ["update", "edit"]]);
        $this->middleware("permission:role-show", ["only"=> ["show"]]);
        $this->middleware("permission:role-delete", ["only"=> ["destroy"]]);
    }

    public function index()
    {
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

    public function addPermissionsToRole($roleId)
    {

        $permissions = Permission::orderBy('created_at', 'desc')->get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $roleId)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view("role-permission.role.add-permissions", compact('role', 'permissions', 'rolePermissions'));
    }

    public function givePermissionsToRole($roleId, Request $request)
    {
        $request->validate([
            'permissions' => ['required']
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permissions);

        $messages = "Permissions accordée(s)";
        return redirect()->route('roles.index', compact('role'))->with('status', $messages);
    }
}
