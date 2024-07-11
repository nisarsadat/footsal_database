<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Http\Requests\StoreHallRequest;
use App\Http\Requests\UpdateHallRequest;
use App\Http\Resources\HallResource;
use Illuminate\Http\Request;

class HallController extends Controller
{





    // public function __construct()
    // {
    //     $this->middleware('permission:hall update')->only(['index', 'show']);
    //     $this->middleware('permission:hall write')->only(['store']);
    //     $this->middleware('permission:hall edit')->only(['update']);
    //     $this->middleware('permission:hall delete')->only(['destroy']);
    // }



    // public function __construct()
    // {
    //     $this->middleware('permission:view customers')->only(['index', 'show']);
    //     $this->middleware('permission:create customers')->only(['store']);
    //     $this->middleware('permission:edit customers')->only(['update']);
    //     $this->middleware('permission:delete customers')->only(['destroy']);
    // }




    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings
        $hallRow = Hall::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        return HallResource::collection($hallRow);

        // $hall= Hall::all();
        // return response()->json(["data"=>$hall]);
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
    public function store(StoreHallRequest $request)
    {
        $validatedDate=$request->validate([
            'name'=>"string",
            'size'=>"string",
        ]);
        $hall=Hall::create($validatedDate);
        return response()->json(["data"=>$hall]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {

        return new HallResource($hall);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $validated=$request->validate([
            'name'=>"string",
            'size'=>"string",
        ]);
        $hall->update($validated);
        return response()->json(["data"=>$hall]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {   $id=$hall->id;
        $hall->delete();
        return "deleted".$id;
    }
}
