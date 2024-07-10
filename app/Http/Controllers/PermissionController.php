<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $validatedData=$request->validate([
            "name"=>"string",
            "guard_name"=>"string"
        ]);


        $permission = Permission::create([
            'name' => $validatedData['name'],
            'guard_name' => $validatedData['guard_name'],
        ]);
        // return "ok";

        return response()->json($permission, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {

        $validatedData=$request->validate([
            "name"=>"string",
            "guard_name"=>"string"
        ]);

        $permission->update($validatedData);
        return response()->json(["data"=>$permission]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $id=$permission->id;
        $permission->delete();
        return "deleted".$id;

    }
}
