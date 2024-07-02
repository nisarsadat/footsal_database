<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Http\Resources\OwnerResource;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings
        $bookings = Owner::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        return OwnerResource::collection($bookings);


        // $owner= Owner::all();
        // return response()->json(["data"=>$owner]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOwnerRequest $request)
    {
        // return "Allham-Do-LLah";
        $validatedDate=$request->validated();
        $owner=Owner::create($validatedDate);
        return response()->json(["data"=>$owner]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {

        return new OwnerResource($owner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $validated=$request->validated();
        $owner->update($validated);
        return response()->json(["data"=>$owner]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $id=$owner->id;
        $owner->delete();
        return "deleted"." ".$id;
        return 'deleted';
    }
}
