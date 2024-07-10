<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
// use App\Models\Role;
// use App\Models\Permission;
// use App\Models\Role;
// use App\Models\Role;
// use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\ DB;


// use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        // return "ok";
        $validatedData=$request->validate([
            "name"=>"string",
            // "guard_name"=>"string"
        ]);


        $role = Role::create([
            'name' => $validatedData['name'],
            // 'guard_name' => $validatedData['guard_name'],
        ]);

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
         // Find the role by ID
        //  $role = Role::findOrFail($roleId);

         // Get the role's permissions
         $permissions = $role->permissions->pluck('name'); // Get permission names

         // Prepare the response
         $response = [
             'role_id' => $role->id,
             'role_name' => $role->name,
             'permissions' => $permissions
         ];

         return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {

        $validatedData=$request->validate([
            "name"=>"string",
            // "guard_name"=>"string"
        ]);

        $role->update($validatedData);
        return response()->json(["data"=>$role]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $id=$roleId->id;
        $roleId->delete();
        return "deleted".$id;

    }






    public function addPermissionToRole(Role $role)
    {


        $permissions = Permission::get();
        $role = Role::findOrFail($role->id);
        $rolePermissions =  DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return ( $rolePermissions);



    }


    // public function givePermissionToRole(RoleRequest $request,$roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required|array', // Ensure 'permission' is an array


    //     ]);

    //     // return $role;
    //     $role=Role::findOrFail($roleId);

    //     $role->syncPermissions($request->permission);
    //     return response()->json(['message' => 'Permission(s) added to role successfully.']);

    //     // return $request->permission[1];
    //     // $request->permission->syncRoles($role);


    // }






    // public function givePermissionToRole(RoleRequest $request, $roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required|array', // Ensure 'permission' is an array
    //     ]);

    //     // Find the role by ID
    //     $role = Role::findOrFail($roleId);

    //     // Create permissions if they do not exist
    //     foreach ($request->permission as $permissionName) {
    //         Permission::findOrCreate($permissionName, 'guard');
    //     }

    //     // Sync the permissions to the role
    //     $role->syncPermissions($request->permission);

    //     return response()->json(['message' => 'Permission(s) added to role successfully.']);
    // }



    // public function givePermissionToRole(RoleRequest $request, $roleId)
    // {
    //     $request->validate([
    //         'permission' => 'required|array', // Ensure 'permission' is an array
    //     ]);

    //     // Specify the guard name (adjust if you are using a different guard)
    //     $guardName = 'web';

    //     // Find the role by ID and ensure the correct guard is used
    //     $role = Role::where('id', $roleId)->where('guard_name', $guardName)->firstOrFail();

    //     // Create permissions if they do not exist, with the correct guard
    //     foreach ($request->permission as $permissionName) {
    //         Permission::findOrCreate($permissionName, $guardName);
    //     }

    //     // Sync the permissions to the role, ensuring the guard matches
    //     $role->syncPermissions($request->permission);

    //     return response()->json(['message' => 'Permission(s) added to role successfully.']);
    // }



    public function givePermissionToRole(RoleRequest $request, $roleId)
    {
        $request->validate([
            'permission' => 'required|array', // Ensure 'permission' is an array
        ]);

        // Specify the guard name (adjust if you are using a different guard)
        $guardName = 'web';

        // Find the role by ID and ensure the correct guard is used
        $role = Role::where('id', $roleId)->where('guard_name', $guardName)->firstOrFail();

        // Create permissions if they do not exist, with the correct guard
        foreach ($request->permission as $permissionName) {
            Permission::findOrCreate($permissionName, $guardName);
        }

        // Sync the permissions to the role, ensuring the guard matches
        $role->syncPermissions($request->permission);

        return response()->json(['message' => 'Permission(s) added to role successfully.']);
    }

}
