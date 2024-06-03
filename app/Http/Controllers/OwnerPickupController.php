<?php

namespace App\Http\Controllers;

use App\Models\OwnerPickup;
use App\Http\Requests\StoreOwnerPickupRequest;
use App\Http\Requests\UpdateOwnerPickupRequest;
use App\Http\Resources\OwnerPickupResource;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerPickupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings
        $bookings = OwnerPickup::with([])->paginate($perPage);

        // Return paginated collection of BookingResource
        return OwnerPickupResource::collection($bookings);


        // return "Allham-Do-Llah";
        // $ownerPickup= OwnerPickup::all();
        // return response()->json(["data"=>$ownerPickup]);
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
    public function store(StoreOwnerPickupRequest $request)
    {
        $validatedDate=$request->validated();
        $ownerPickup=OwnerPickup::create($validatedDate);
        return response()->json(["data"=>$ownerPickup]);

    }

    /**
     * Display the specified resource.
     */
    public function show(OwnerPickup $ownerPickup)
    {
        $ownerPickup->load('owner'); // Eager load the relationships


        return new OwnerPickupResource($ownerPickup);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnerPickup $ownerPickup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOwnerPickupRequest $request, OwnerPickup $ownerPickup)
    {
        $validated=$request->validated();
        $ownerPickup->update($validated);
        return response()->json(["data"=>$ownerPickup]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnerPickup $ownerPickup)
    {
        $id=$ownerPickup->id;
        $ownerPickup->delete();
        return "deleted"." ".$id;
        return 'deleted';
    }
}
