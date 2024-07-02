<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use Egulias\EmailValidator\Result\Reason\ExpectingATEXT;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // return ""
        $perPage = $request->query('perPage',10);

        // Fetch paginated bookings
        $bookings = Expense::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        return ExpenseResource::collection($bookings);


        // $expense= Expense::all();
        // return response()->json(["data"=>$expense]);
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
    public function store(StoreExpenseRequest $request)
    {
        $validatedDate=$request->validated();
        $expense=Expense::create($validatedDate);
        return response()->json(["data"=>$expense]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {

        return "ok";
        // $expense->load('expenseCatagory'); // Eager load the relationships


        $expense->load('expenseCatagory'); // Eager load the relationships


        // return new ExpenseResource($expense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $validated=$request->validated();
        $expense->update($validated);
        return response()->json(["data"=>$expense]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $id=$expense->id;
        $expense->delete();
        return "deleted"." ".$id;
        return 'deleted';
    }
}
