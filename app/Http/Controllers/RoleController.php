<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions=Permission::all();
        $desig= User::select('desig')->distinct()->get();
        $users=User::all();
       /// dd($desig);
        return view('roles', compact('roles','permissions','desig','users'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('status', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }
    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array', // Validate that 'permissions' is an array
        ]);

        $permissions = $request->input('permissions', []);

        // Sync the role's permissions with the selected permissions
       // $role->syncPermissions($permissions);
       $role->givePermissionTo($permissions);
        return redirect()->back()->with('status', 'Permissions updated successfully.');
    }
    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')->with('status', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Role deleted successfully.');
    }
    public function assignRolesByDesignation(Request $request)
    {
        // Validate the form data
        $request->validate([
            'designation' => 'required|string',
            'role' => 'required|string',
            //'permission' => 'required|string',
        ]);

        // Find users with the given designation
        $users = User::where('desig', $request->input('designation'))->get();

        // Assign roles and permissions to users with the given designation
        foreach ($users as $user) {
            $user->assignRole($request->input('role')); 
           // $user->givePermissionTo($request->input('permission'));
        }

        return redirect()->back()->with('status', 'Roles and permissions assigned successfully by designation.');
    }

    public function assignPermissionToUser(Request $request)
    {
        // Validate the form data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::findOrFail($request->input('user_id'));

        // Assign role and permission to the specific user

        $user->givePermissionTo($request->input('permission'));

        return redirect()->back()->with('status', 'Roles and permissions assigned successfully to the user.');
    }
}
