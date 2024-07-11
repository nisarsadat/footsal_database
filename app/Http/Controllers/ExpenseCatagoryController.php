<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCatagory;
use App\Http\Requests\StoreExpenseCatagoryRequest;
use App\Http\Requests\UpdateExpenseCatagoryRequest;
use App\Http\Resources\ExpenseCatagoryResource;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;

class ExpenseCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = $request->query('perPage');

        // Fetch paginated bookings
        $expenseCatagory = ExpenseCatagory::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        return ExpenseCatagoryResource::collection($expenseCatagory);
        // $expenseCatagory= ExpenseCatagory::all();
        // return response()->json(["data"=>$expenseCatagory]);

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
    public function store(StoreExpenseCatagoryRequest $request)
    {
        $validatedDate=$request->validated();
        $expenseCatagory=ExpenseCatagory::create($validatedDate);
        return response()->json(["data"=>$expenseCatagory]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseCatagory $expenseCatagory)
    {
        // $category = ExpenseCatagory::findOrFail($expenseCatagory);
    return new ExpenseCatagoryResource($expenseCatagory);



        dd($expenseCatagory);
        return new ExpenseCatagoryResource($expenseCatagory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseCatagory $expenseCatagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseCatagoryRequest $request, ExpenseCatagory $expenseCatagory)
    {
        $validated=$request->validated();
        $expenseCatagory->update($validated);
        return response()->json(["data"=>$expenseCatagory]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCatagory $expenseCatagory)
    {
        $id=$expenseCatagory->id;
        $expenseCatagory->delete();
        return "deleted"." ".$id;
        return 'deleted';

    }
}
